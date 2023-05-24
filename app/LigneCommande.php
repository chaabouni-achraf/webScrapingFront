<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{   protected $table="lignecommandes";
    protected $fillable = [ 
          'prix','commande_id','galerie_id','description','date_livraison','adresse_liv','consigne','note','type',
    ];
}
