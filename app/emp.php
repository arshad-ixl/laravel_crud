<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emp extends Model
{
    protected $fillable = [ 'created_at', 'updated_at',
     'emp_name', 'emp_email','emp_city','emp_phone','emp_img'];
}
