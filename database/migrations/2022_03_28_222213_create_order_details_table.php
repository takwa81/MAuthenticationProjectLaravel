<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            // $table->bigInteger('order_id')->unsigned();
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->bigInteger('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            // $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            // $table->bigInteger('user_id')->unsigned();
        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('order_id');
            // $table->unsignedBigInteger('product_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            $table->integer('count');
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('')->onDelete('cascade');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
