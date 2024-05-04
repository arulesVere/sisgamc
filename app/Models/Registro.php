<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="registro";
    protected $primaryKey="idregistro";
    protected $fillable = [
        'idfolder',
        'idprestamo',
        'cantidad',
    ];
}

