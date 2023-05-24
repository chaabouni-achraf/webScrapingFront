<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneLocation extends Model
{   protected $table="lignelocations";
    protected $fillable = [ 
          'location_id','galerie_id','description_loc','date_location','date_livraison','prix','loc_prenom','loc_name','date_livraison_reel','date_retoure','Adresse_livraison','retourne','note','garantie_reser','garantie_livrai',
    ];
}
