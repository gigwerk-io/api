<?php

use App\Enums\ApplicationStatus;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateApplicationsTable.
 */
class CreateApplicationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applications', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_id');
            $table->integer('status')->default(ApplicationStatus::NEW);


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applications');
	}
}
