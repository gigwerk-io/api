<?php

use App\Enums\ApplicationEventType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateApplicationEventsTable.
 */
class CreateApplicationEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_events', function(Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications');
            $table->integer('event_type')->default(ApplicationEventType::OTHER);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('completed')->default(false);

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
		Schema::drop('application_events');
	}
}
