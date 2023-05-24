<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class Galerie extends Authenticatable
{
    protected $guard = 'galeries';

    protected $fillable = [
        'photo', 'critere1', 'critere2','critere3','critere4','couleur','description','temporaire','type','suppression','reference',
    ];

  
}
