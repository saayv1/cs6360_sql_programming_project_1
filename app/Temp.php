<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{


    //

    protected $table='temp';

    protected $primaryKey = 'ISBN10';

    public $timestamps=false;
}

