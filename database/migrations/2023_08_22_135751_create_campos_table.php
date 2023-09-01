<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->boolean('obligatorio')->default(false);
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->unsignedBigInteger('formulario_id');
            $table->timestamps();

            $table->foreign('formulario_id')->references('id')->on('formularios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campos');
    }
}
