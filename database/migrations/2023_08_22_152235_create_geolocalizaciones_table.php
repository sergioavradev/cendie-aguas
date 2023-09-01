<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeolocalizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geolocalizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campo_id');
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8); 
            $table->timestamps();
    
            $table->foreign('campo_id')->references('id')->on('campos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geolocalizaciones');
    }
}
