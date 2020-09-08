<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientNameToMarketplacejobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketplace_jobs', function (Blueprint $table) {
            $table->string('client_name')->after('category_id')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('marketplace_jobs', 'client_name')) {
            Schema::table('marketplace_jobs', function (Blueprint $table) {
                $table->dropColumn('client_name');
            });
        }
    }
}
