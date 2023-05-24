<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignelocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignelocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('galerie_id');
            $table->foreign('galerie_id')->references('id_galerie')->on('galeries');
            $table->string('description_loc');
            $table->date('date_location');
            $table->date('date_livraison');
            $table->float('prix');
            $table->string('loc_prenom');
            $table->string('loc_name');
            $table->date('date_livraison_reel');
            $table->date('date_retoure');
            $table->string('Adresse_livraison');
            $table->string('retourne');
            $table->string('note');
            $table->string('garantie_reser');
            $table->string('garantie_livrai');
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
        Schema::dropIfExists('lignelocations');
    }
}
