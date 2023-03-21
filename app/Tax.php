<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'finance_tax';

    protected $fillable = [
        'name', 'des', 'unit','total','date',
    ];
}
