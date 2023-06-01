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
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->integer('stock'); //del 1 hatas 9999
            $table->float('precio', 4);

            //si borro a un usuario tambien se debera borrar su id en esta tabla
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            //si borro un provedor tambien se debera borrar su id en esta tabla
            $table->foreignId('provider_id')->constrained()->references('id')->on('providers')->onDelete('cascade');
            //si borro una categoria tambien se debera borrar su id en esta tabla
            $table->foreignId('category_id')->constrained()->references('id')->on('categories')->onDelete('cascade');


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
