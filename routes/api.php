<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Auth')->group(function (){
    Route::post('register', 'RegisterController@userRegistration')->name('user.registration');
    Route::post('login', 'LoginController@login')->name('login');


    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('validate', 'LoginController@tokenValidation')->name('validate.token');
        Route::post('business-register', 'RegisterController@businessRegistration')->name('business.registration');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

});

Route::prefix('business/{unique_id}')->group(function (){
    Route::namespace('Auth')->group(function () {
        Route::post('login', 'LoginController@businessLogin')->name('business.login');
        Route::middleware(['auth:sanctum'])->group(function (){
            Route::post('join', 'RegisterController@joinBusiness')->name('join.business');
            Route::get('validate', 'LoginController@businessTokenValidation')
                ->middleware('business.access')
                ->name('business.validate');
        });
    });

    Route::namespace('Business')->group(function () {
        Route::middleware(['auth:sanctum', 'business.access', 'business.owner'])->group(function () {
            Route::patch('profile', 'AccountController@updateProfile')->name('update.business.profile');
            Route::patch('location', 'AccountController@updateLocation')->name('update.business.location');
            Route::get('stripe', 'AccountController@stripeLogin')->name('business.stripe.login');

            Route::get('applicants', 'ApplicantController@index')->name('all.applicants');
            Route::get('applicant/{id}', 'ApplicantController@show')->name('show.applicant');
            Route::post('applicant/{id}/approve', 'ApplicantController@approve')->name('approve.applicant');
            Route::post('applicant/{id}/reject', 'ApplicantController@reject')->name('reject.applicant');
            Route::delete('applicant/{id}', 'ApplicantController@delete')->name('delete.application');


            Route::get('user-stats', 'DashboardController@userStats')->name('user.stats');
            Route::get('traffic-stats', 'DashboardController@trafficStats')->name('traffic.stats');
            Route::get('time-worked', 'DashboardController@totalTimeWorked')->name('time.worked');
            Route::get('jobs-graph', 'DashboardController@jobsGraph')->name('jobs.graph');
            Route::get('payouts-graph', 'DashboardController@payoutsGraph')->name('payouts.graph');
            Route::get('leaderboard', 'DashboardController@leaderboard')->name('business.leaderboard');

            Route::get('users', 'UserController@index')->name('business.all.users');
            Route::get('user/{id}', 'UserController@show')->name('business.show.user');
            Route::patch('user/{id}', 'UserController@update')->name('business.update.user');
            Route::delete('user/{id}', 'UserController@delete')->name('business.remove.user');

        });
    });

    Route::namespace('Chat')->group(function (){
        Route::middleware(['auth:sanctum', 'business.access'])->group(function (){
            Route::get('rooms', 'RoomController@index')->name('all.chat.rooms');
            Route::get('room/{room_id}', 'RoomController@show')->name('single.chat.room');
            Route::get('chat/{username}', 'RoomController@store')->name('find.chat.room');
            Route::post('message/{room_id}', 'MessageController@store')->name('send.message');
        });
    });

    Route::namespace('Marketplace')->group(function (){
        Route::middleware(['auth:sanctum', 'business.access'])->group(function (){

            // Job Request Controller Route:
            Route::post('marketplace/job', 'JobRequestController@submit')
                ->middleware('has.payment.method')
                ->name('submit.job');

            // Feed Controllers:
            Route::get('marketplace/feed', 'FeedController@feed')->name('job.feed');
            Route::get('marketplace/me', 'FeedController@myJobRequests')->name('customer.jobs');
            Route::get('marketplace/proposals', 'FeedController@myProposals')->name('worker.jobs');

            Route::middleware('job.exists')->group(function (){
                Route::get('marketplace/job/{id}', 'FeedController@show')->name('view.job');

                // Must be job owner to perform actions:
                Route::middleware('job.owner')->group(function (){
                    Route::post('marketplace/job/{id}/approve/{freelancer_id}', 'CustomerActionsController@approve')->name('approve.freelancer');
                    Route::post('marketplace/job/{id}/reject/{freelancer_id}', 'CustomerActionsController@reject')->name('reject.freelancer');
                    Route::delete('marketplace/job/{id}', 'CustomerActionsController@cancel')->name('cancel.job');
                    Route::post('marketplace/job/{id}/review', 'CustomerActionsController@review')->name('review.job');

                    Route::patch('marketplace/job/{id}', 'JobRequestController@edit')->name('edit.job');
                });

                Route::middleware(['is.freelancer', 'has.payout.method'])->group(function (){
                    Route::post('marketplace/job/{id}/accept', 'FreelancerActionsController@accept')->name('accept.job');
                    Route::post('marketplace/job/{id}/withdraw', 'FreelancerActionsController@withdraw')->name('withdraw.job');
                    Route::post('marketplace/job/{id}/arrive', 'FreelancerActionsController@arrive')->name('freelancer.arrive');
                    Route::post('marketplace/job/{id}/complete', 'FreelancerActionsController@complete')->name('freelancer.complete');
                });
            });


        });
    });

    Route::namespace('User')->group(function (){
        Route::middleware(['auth:sanctum', 'business.access'])->group(function (){
            Route::post('apn', 'AccountController@updateApnToken')->name('save.apn.token');
            Route::post('fcm', 'AccountController@updateFcmToken')->name('save.fcm.token');
            Route::post('preferences', 'AccountController@updateNotificationPreferences')->name('update.notification.preferences');

            Route::get('profile/{user_id}', 'ProfileController@show')->name('show.user.profile');
        });
    });
});

Route::namespace('User')->group(function (){
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::patch('profile', 'ProfileController@update')->name('update.user.profile');
    });
});
