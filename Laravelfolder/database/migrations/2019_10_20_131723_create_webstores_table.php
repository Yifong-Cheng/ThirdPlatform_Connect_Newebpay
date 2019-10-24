<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webstores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MerchantID');
            $table->string('TradeInfo');
            $table->string('TradeSha');
            $table->string('ResponsdType');
            $table->string('TimeStamp');   
            $table->string('Version');
			$table->string('MerchantOrderNo');
			$table->string('Amt');
			$table->string('ItemDesc');
			$table->string('Email');
			$table->string('LoginType');
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
        Schema::dropIfExists('webstores');
    }
}
