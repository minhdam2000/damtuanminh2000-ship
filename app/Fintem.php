<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fintem extends Model
{
    protected $table = 'fintem';

    protected $fillable = [
        'name', 'des', 'stt','myid','money','id'
    ];
}
