<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePepeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pepe', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pipo',255);
            $table->text('contenido');
            $table->string('image_url');
            $table->integer('numerodepipo');
            $table->integer('dinerodepipo');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pepe');
    }
}
