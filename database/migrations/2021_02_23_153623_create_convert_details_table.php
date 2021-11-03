<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvertDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convert_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('convert_id')->unsigned();
            $table->double('total',20,4)->default(0);
            $table->double('price',20,4)->default(0);
            $table->double('receive',20,8)->default(0);
            $table->timestamps();

            $table->foreign('convert_id')->references('id')->on('converts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convert_details');
    }
}
