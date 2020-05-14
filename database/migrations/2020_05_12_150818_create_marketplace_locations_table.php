<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMarketplaceLocationsTable.
 */
class CreateMarketplaceLocationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketplace_locations', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketplace_id');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->double('lat');
            $table->double('long');

            $table->foreign('marketplace_id')->references('id')->on('marketplace_jobs');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('marketplace_locations');
	}
}
