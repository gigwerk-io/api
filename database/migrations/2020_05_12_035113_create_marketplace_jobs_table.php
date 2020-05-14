<?php

use App\Enum\Marketplace\Status;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMarketplaceJobsTable.
 */
class CreateMarketplaceJobsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketplace_jobs', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('category_id');
            $table->double('price', 8, 2);
            $table->mediumText('description');
            $table->unsignedBigInteger('status_id')->default(Status::REQUESTED);
            $table->unsignedBigInteger('intensity_id');
            $table->timestamp('complete_before');
            $table->integer('views')->default(0);
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
		Schema::drop('marketplace_jobs');
	}
}
