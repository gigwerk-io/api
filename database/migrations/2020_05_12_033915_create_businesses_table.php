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
            $table->text('application_form')->nullable();
            $table->string('application_form_name')->nullable();
            $table->string('application_form_description')->nullable();

            $table->foreign('owner_id')->references('id')->on('users');
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
