<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $fillable= [
        'clave_sat',
        'concepto'
    ];
}
