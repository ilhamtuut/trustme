<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['request','rejected','sending','accepted'])->default('request');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty');
            $table->integer('weight');
            $table->integer('total');
            $table->string('city');
            $table->string('province');
            $table->string('zip');
            $table->integer('cost')->nullable();
            $table->string('courier')->nullable();
            $table->string('resi')->nullable();
            $table->text('information');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_checkouts');
    }
}
