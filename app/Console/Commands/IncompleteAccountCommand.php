<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\PaymentMethodRepository;
use App\Contracts\Repositories\UserRepository;
use App\Mail\Business\IncompleteAccountMailable;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailer;

class IncompleteAccountCommand extends Command
{
    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var PaymentMethodRepository
     */
    private $paymentMethodRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:incomplete-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly reminder for users to complete their account setup.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct
    (
        UserRepository $userRepository,
        PaymentMethodRepository $paymentMethodRepository,
        Mailer $mailer,
        BusinessRepository $businessRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->mailer = $mailer;
        $this->businessRepository = $businessRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->userRepository as $user) {
            $business = $this->businessRepository->findWhere(['owner_id' => $user->id])->first();

            $paymentMethod = $this->paymentMethodRepository->findWhere(['user_id' => $user->id])->get();
            $businessWorkers = $business->users()->findWhere(['business_id' => $business->id])->get();

            if (is_null($paymentMethod) || is_null($businessWorkers)) {
                $this->mailer->to($user->email)->send(new IncompleteAccountMailable($user, $paymentMethod, $businessWorkers));
            }
        }
    }
}
