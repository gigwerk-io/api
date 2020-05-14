<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBusinessesTable.
 */
class CreateBusinessesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('businesses', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->uuid('unique_id');
            $table->string('name');
            $table->string('subdomain_prefix')->unique();
            $table->string('stripe_connect_id')->nullable();
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->text('short_description'); // seo: 158
            $table->mediumText('long_description')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('businesses');
	}
}
