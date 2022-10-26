<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIntegrationsFromBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('facebook_pixel_id');
            $table->dropColumn('google_analytics_id');
            $table->dropColumn('cloudfront_id');
            $table->dropColumn('s3_bucket_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('facebook_pixel_id')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('cloudfront_id')->nullable();
            $table->string('s3_bucket_id')->nullable();
        });
    }
}
