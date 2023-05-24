<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{   protected $table="commandes";
    protected $fillable = [ 
          'cliente_id','statut','date_commande','total','reste','Accompte','type_abonnement','reference',
    ];
}
