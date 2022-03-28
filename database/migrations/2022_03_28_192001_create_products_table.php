<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            $table->string('price');
            $table->string('description');
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
        Schema::dropIfExists('products');
    }
}

// C:\xampp\htdocs\LaravelProjects\mohamad1jwt-auth-admin-usersapi\vendor\laravel\framework\src\Illuminate\Database\Connection.php:501
// PDOException::("SQLSTATE[HY000]: General error: 1005 Can't create table `test-jwt`.`products` (errno: 150 "Foreign key constraint is
// incorrectly formed")")