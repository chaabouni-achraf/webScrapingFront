<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignecommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignecommandes', function (Blueprint $table) {
            $table->id();
            $table->float('prix');
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')->references('id')->on('commandes');
            $table->unsignedBigInteger('galerie_id');
            $table->foreign('galerie_id')->references('id_galerie')->on('galeries');
            $table->string('description');
            $table->date('date_livraison');
            $table->string('adresse_liv');
            $table->string('consigne');
            $table->string('note');
            $table->string('type');
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
        Schema::dropIfExists('lignecommandes');
    }
}
