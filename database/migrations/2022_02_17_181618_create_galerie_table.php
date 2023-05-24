<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->id_galerie();
            $table->string('photo');
            $table->string('critere1');
            $table->string('critere2');
            $table->string('critere3');
            $table->string('critere4');
            $table->string('couleur');
            $table->string('description');
            $table->string('temporaire');
            $table->string('type');
            $table->string('suppression');
            $table->string('reference');
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
        Schema::dropIfExists('galeries');
    }
}
