<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('balance_id')->unsigned();
            $table->integer('from_id')->unsigned();
            $table->integer('to_id')->unsigned();
            $table->double('amount',20,8)->default(0);
            $table->string('description')->nullable();
            $table->integer('status')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();

            $table->foreign('balance_id')->references('id')->on('balances');
            $table->foreign('from_id')->references('id')->on('users');
            $table->foreign('to_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_transactions');
    }
}
