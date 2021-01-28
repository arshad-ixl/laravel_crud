<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    protected $fillable = [ 'created_at', 'updated_at',
     'city_id', 'city_name','city_state'];
}
