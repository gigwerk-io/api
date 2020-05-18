<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateChatRoomsTable.
 */
class CreateChatRoomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_rooms', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('business_id');
            $table->text('users'); //json

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
		Schema::drop('chat_rooms');
	}
}
