<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class GenerateBuildKeyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a secret key for the cookie app builder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hasher $hasher, Filesystem $filesystem)
    {
        $key = Str::random(32);

        $filesystem->replace(base_path('builder.txt'), $hasher->make($key));

        $this->info('Here is your key: ' . $key);
    }
}
