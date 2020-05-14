<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePaymentsTable.
 */
class CreatePaymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('user_id');
            $table->double('amount', 8, 2);
            $table->string('stripe_token');
            $table->boolean('refunded')->default(false);

            $table->foreign('marketplace_id')->references('id')->on('marketplace_jobs');
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('payments');
	}
}
