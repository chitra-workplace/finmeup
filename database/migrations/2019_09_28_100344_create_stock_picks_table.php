<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockPicksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_picks', function(Blueprint $table)
		{
			$table->bigIncrements('id', true);
			$table->boolean('category')->default(0)->comment('1 for buy, 2 for sell, 3 for hold ');
			$table->string('stock_name', 500)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('listed_in', 250)->nullable();
			$table->float('current_market_price', 10, 0)->default(0);
			$table->float('target_price', 10, 0)->default(0);
			$table->integer('hold_for_days')->default(0);
			$table->integer('hold_for_month')->default(0);
			$table->integer('hold_for_year')->default(0);
			$table->string('image', 500)->nullable();
			$table->boolean('status')->default(1)->comment('1 for active, 2 for Inactive');
			$table->text('reason', 65535)->nullable();
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
		Schema::drop('stock_picks');
	}

}
