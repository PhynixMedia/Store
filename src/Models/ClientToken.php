<?php

namespace Store\Manager\Models;

use Illuminate\Database\Eloquent\Model;

class ClientToken extends Model
{
     //
     protected $table = 'web_store_token';

     /**
      * The attributes that are mass assignable.
      * @var array
      */
     protected $fillable = [
         'token',
         'expires_in'
     ];
}
