<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{   protected $table="locations";
    protected $fillable = [ 
          'cliente_id','statut','total','reste','Accompte','type_abonnement','reference',
    ];
}
