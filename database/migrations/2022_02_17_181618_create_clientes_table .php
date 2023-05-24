<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id_client();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->string('tel1');
            $table->string('tel2');
            $table->string('adresse');
            $table->string('CP');
            $table->string('ville');
            $table->string('pays');
            $table->string('note');
            $table->string('reference');
            $table->string('date_mesure');
            $table->string('Tour_Poitrine');
            $table->string('Tour_Taille');
            $table->string('Tour_Hanches');
            $table->string('Carrure_Devant');
            $table->string('Carrure_Dos');
            $table->string('Ecart_Poitrine');
            $table->string('Tour_Ventre');
            $table->string('Longueur_Robe');
            $table->string('Longueur_Manche ');
            $table->string('Largeur_Manches');
            $table->string('Longueur_Bustier ');
            $table->string('Longueur_Jupe');
            $table->string('Longueur_Pantalon');
            $table->string('Largeur_Pantalon');
            $table->string('Longueur_Veste');
            $table->string('Longueur_Manche2');
            $table->string('Broderie');
            $table->string('remarque');
            $table->string('mesure_id');
            $table->string('suppression');
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
        Schema::dropIfExists('clientes');
    }
}
