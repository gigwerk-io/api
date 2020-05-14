<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMarketplaceProposalsTable.
 */
class CreateMarketplaceProposalsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketplace_proposals', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->enum('rating', [1,2,3,4,5])->nullable();
            $table->mediumText('review')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('completed_at')->nullable();

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
		Schema::drop('marketplace_proposals');
	}
}
