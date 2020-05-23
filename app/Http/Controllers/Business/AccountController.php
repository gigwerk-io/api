<?php

namespace App\Http\Controllers\Business;

use App\Annotation\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @Group(name="Account", description="These routes belong are responsible for managing business accounts.")
 */
class AccountController extends Controller
{
    // update profile & name
    // update location
    // update stripe account
    // notification preferences: new application, updated job status, payout,
    // business status. Are you looking for more workers, at capacity, etc?
    // weekly summary opt in
    // deactivate org
    // transfer ownership
    // subscription tier
    // jobs that need attention
    // applications that need attention
    // missing steps as a business (banner)
}
