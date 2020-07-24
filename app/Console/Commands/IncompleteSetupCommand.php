<?php

namespace App\Console\Commands;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\PaymentMethodRepository;
use App\Contracts\Repositories\UserRepository;
use App\Mail\Business\IncompleteSetupMailable;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailer;

class IncompleteSetupCommand extends Command
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
    protected $signature = 'command:IncompleteAccount';

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

            if (is_null($paymentMethod) && is_null($businessWorkers)) {
                $message = "Don't forget to promote your business, you currently have no workers.
                            Please make sure to set up a payment method so you can start a business, start working,
                            and request jobs. Simply navigate to your settings, select the add payment method option,
                            and enter your credentials.";
                $this->mailer->to($user->email)->send(new IncompleteSetupMailable($user, $message));
            }

            if (is_null($paymentMethod) && !is_null($businessWorkers)) {
                $message = "Please make sure to set up a payment method so you can start a business,
                            start working, and request jobs.";
                $this->mailer->to($user->email)->send(new IncompleteSetupMailable($user, $message));
            }

            if (!is_null($paymentMethod) && is_null($businessWorkers)) {
                $message = "Don't forget to promote your business, you currently have no workers.";
                $this->mailer->to($user->email)->send(new IncompleteSetupMailable($user, $message));
            }
        }
    }
}
