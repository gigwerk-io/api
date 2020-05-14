<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateChatMessagesTable.
 */
class CreateChatMessagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_messages', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('room_id');
            $table->unsignedBigInteger('sender_id');
            $table->mediumText('text');

            $table->foreign('room_id')->references('id')->on('chat_rooms');
            $table->foreign('sender_id')->references('id')->on('users');
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
		Schema::drop('chat_messages');
	}
}
