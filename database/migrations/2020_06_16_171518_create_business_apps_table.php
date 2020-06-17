<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBusinessAppsTable.
 */
class CreateBusinessAppsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_apps', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->string('domain');
            $table->string('s3_bucket')->nullable();
            $table->longText('apn_certificate')->nullable();
            $table->longText('fcm_certificate')->nullable();

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
		Schema::drop('business_apps');
	}
}
