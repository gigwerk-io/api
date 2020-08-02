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
        /** @var \App\Models\Business $businesses */
        $businesses = $this->businessRepository->all();

        foreach ($businesses as $business) {
            /** @var \App\Models\Business $business */

            /** @var \App\Models\User $owner */
            $owner = $business->owner()->first();

            if ($business->paymentMethods()->count() > 0 || $business->marketplaceJobs()->count() > 0 || $business->users()->count() > 1 || $business->applications()->count() > 0) {
                $this->mailer->to($owner->email)->send(new IncompleteAccountMailable($owner, $business));
            }
        }
    }
}
