<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');    //pan bimbo
            $table->float('precio', 4);  //9.80
            $table->integer('stock');    //del 1 hatas 9999
            //si borro a un usuario tambien se debera borrar su id en esta tabla
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('supplies');
    }
}
