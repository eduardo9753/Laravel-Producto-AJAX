<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juices', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');    //jugo especial
            $table->string('imagen');    //jugoespecial.png
            $table->double('precio');    //9.80
            $table->text('descripcion'); //descripcion del producto
            
            $table->foreignId('user_id')
                ->constrained('id')
                ->on('users')
                ->onDelete('cascade'); //usuario quien registra

            $table->foreignId('type_id')
                ->nullable()
                ->constrained('id')
                ->on('types')
                ->nullOnDelete(); //tipo de jugo

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
        Schema::dropIfExists('juices');
    }
}
