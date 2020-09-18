<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesAndEventsToApplicationEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_events', function (Blueprint $table) {
            $table->string('google_calendar_id')->after('completed')->nullable();
            $table->string('timezone')->after('end_time');
            $table->mediumText('notes')->after('timezone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_events', function (Blueprint $table) {
            $table->dropColumn(['google_calendar_id', 'notes', 'timezone']);
        });
    }
}
