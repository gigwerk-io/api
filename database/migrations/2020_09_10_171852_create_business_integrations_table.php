<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBusinessIntegrationsTable.
 */
class CreateBusinessIntegrationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_integrations', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('facebook_pixel_id')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('cloudfront_id')->nullable();
            $table->string('s3_bucket_id')->nullable();
            $table->string('google_access_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->timestamp('google_expiration')->nullable();

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
		Schema::drop('business_integrations');
	}
}
