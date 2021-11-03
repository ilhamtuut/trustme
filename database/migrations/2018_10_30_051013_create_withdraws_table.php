<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice')->nullable();
            $table->integer('user_id')->unsigned();
            $table->double('amount',20,4)->default(0);
            $table->double('price',20,4)->default(0);
            $table->double('total',20,4)->default(0);
            $table->double('fee',20,4)->default(0);
            $table->double('receive',20,4)->default(0);
            $table->integer('status')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->text('json')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
