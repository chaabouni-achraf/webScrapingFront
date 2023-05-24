<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotogaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_galeries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galerie_id');
            $table->foreign('galerie_id')->references('id_galerie')->on('galeries')->onDelete('cascade');
            $table->string('photo1');
          
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
        Schema::dropIfExists('photo_galeries');
    }
}
