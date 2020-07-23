<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateBusinessAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:app {uuid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually create a business progressive web app in AWS via Terraform.';

    /**
     * @var BusinessRepository
     */
    protected $businessRepository;

    /**
     * @var FilesystemManager
     */
    protected $filesystemManager;

    /**
     * @var Business
     */
    protected $business;

    /**
     * @var string
     */
    protected $tempTerraformDirectory;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Create a new command instance.
     *
     * @param BusinessRepository $businessRepository
     * @param FilesystemManager $filesystemManager
     * @param Logger $logger
     */
    public function __construct(BusinessRepository $businessRepository, FilesystemManager $filesystemManager, Logger $logger)
    {
        parent::__construct();
        $this->businessRepository = $businessRepository;
        $this->filesystemManager = $filesystemManager;
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!app()->environment('staging', 'production')) {
            $this->error(sprintf('This command is not available in the %s environment', app()->environment()));
            return 1;
        }

        $foundBusiness = $this->task('Finding the business.', function () {
            try {
                $this->business = $this->businessRepository->findByUuid($this->argument('uuid'));
                return true;
            }catch (ModelNotFoundException $modelNotFoundException) {
                $this->error($modelNotFoundException->getMessage());
                return false;
            }
        });

        if (!$foundBusiness) {
            return 1;
        }


        $createdTerraformTempFile = $this->task('Create temporary Terraform file', function () {
            $terraformFileContent = file_get_contents(base_path('create-web-app.tf'));

            $domain = $this->business->subdomain_prefix . '.' . config('app.url_suffix');
            $this->business->businessApp()->update(['s3_bucket' => $domain]);
            $terraformFileContent = str_replace('{ACCESS_KEY}', config('filesystems.disks.s3.key'), $terraformFileContent);
            $terraformFileContent = str_replace('{SECRET_KEY}', config('filesystems.disks.s3.secret'), $terraformFileContent);
            $terraformFileContent = str_replace('{BUSINESS_DOMAIN}', $domain, $terraformFileContent);

            $this->tempTerraformDirectory = Str::uuid();
            return $this->filesystemManager->disk('local')->put($this->tempTerraformDirectory . '/main.temp.tf', $terraformFileContent);
        });

        if (!$createdTerraformTempFile) {
            $this->error('Failed to create the temporary Terraform file.');
            return 1;
        }

        $terraformTempLocation = storage_path('app/' . $this->tempTerraformDirectory);

        $this->task('Initialize Terraform in directory', function () use ($terraformTempLocation) {
            $output = shell_exec('cd ' . $terraformTempLocation . '&& terraform init 2>&1');
            if (Str::contains($output, 'Error')) {
                $this->logger->error($output);
                return false;
            }
            $this->logger->info($output);
            return true;
        });

        $this->task('Generate Terraform binary', function () use ($terraformTempLocation) {
            $output = shell_exec('cd ' . $terraformTempLocation . '&& terraform plan -out=tfout 2>&1');
            if (Str::contains($output, 'Error')) {
                $this->logger->error($output);
                return false;
            }
            $this->logger->info($output);
            return true;
        });

        $this->task('Run the Terraform binary', function () use ($terraformTempLocation) {
            $output = shell_exec('cd ' . $terraformTempLocation . '&& terraform apply tfout 2>&1');
            if (Str::contains($output, 'Error')) {
                $this->logger->error($output);
                return false;
            }
            $this->logger->info($output);
            return true;
        });

        return 0;
    }
}
