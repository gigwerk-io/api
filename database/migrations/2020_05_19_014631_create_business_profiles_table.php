<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBusinessProfilesTable.
 */
class CreateBusinessProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_profiles', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->text('short_description')->nullable(); // seo: 158
            $table->mediumText('long_description')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();

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
		Schema::drop('business_profiles');
	}
}
