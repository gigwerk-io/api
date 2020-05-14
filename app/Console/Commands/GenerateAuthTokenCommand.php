<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateAuthTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:token {username=business_admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an auth token for a user.';

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
     * @param UserRepository $userRepository
     * @return mixed
     * @throws \Exception
     */
    public function handle(UserRepository $userRepository)
    {
        $username = $this->argument('username');
        /** @var User $user */
        $user = $userRepository->findWhere(['username' => $username])->first();

        if(is_null($user)){
            throw new \Exception(sprintf('The username %s was not found.', $username));
        }

        $token = $user->createToken('auth-token');

        print $token->plainTextToken . PHP_EOL;

        return 0;
    }
}
