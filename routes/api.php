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
});

Route::prefix('business/{unique_id}')->group(function (){
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
                    Route::patch('marketplace/job/{id}', 'JobRequestController@edit')->name('edit.job');
                });
            });


        });
    });
});
