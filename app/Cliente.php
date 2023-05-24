<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Authenticatable
{
    protected $guard = 'clientes';

    protected $fillable = [
        'prenom','nom', 'email', 'tel1','tel2','adresse', 'CP','ville', 'pays', 'note','reference','date_mesure', 'Tour_Poitrine','Tour_Taille', 'Tour_Hanches', 'Carrure_Devant','Carrure_Dos','Ecart_Poitrine', 'Tour_Ventre','Longueur_Robe', 'Longueur_Manche', 'Largeur_Manches','Longueur_Bustier','Longueur_Jupe','Longueur_Pantalon', 'Largeur_Pantalon','Longueur_Veste','Longueur_Manche2','Broderie','remarque','mesure_id','suppression',
    ];

   
}
