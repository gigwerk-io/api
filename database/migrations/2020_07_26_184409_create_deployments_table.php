<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDeploymentsTable.
 */
class CreateDeploymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deployments', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('deployment_status_id');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('deployment_status_id')->references('id')->on('deployment_statuses');
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
		Schema::drop('deployments');
	}
}
