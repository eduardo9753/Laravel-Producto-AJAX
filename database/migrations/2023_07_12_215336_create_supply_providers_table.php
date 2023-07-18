<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_providers', function (Blueprint $table) {
            $table->id();
            //si borro un provedor tambien se debera borrar su id en esta tabla
            $table->foreignId('provider_id')
                ->constrained('id')
                ->on('providers')
                ->onDelete('cascade');

            //si borro un provedor tambien se debera borrar su id en esta tabla
            $table->foreignId('supply_id')
                ->constrained('id')
                ->on('supplies')
                ->onDelete('cascade');
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
        Schema::dropIfExists('supply_providers');
    }
}
