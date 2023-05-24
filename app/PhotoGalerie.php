<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class PhotoGalerie extends Authenticatable
{
    protected $guard = 'photo_galeries';

    protected $fillable = [
        'galerie_id','photo1',
    ];

  
}
