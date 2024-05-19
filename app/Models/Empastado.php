<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empastado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="empastado";
    protected $primaryKey="idempastado";
    protected $fillable = [
        'codigo',
        'numero',
        'fecha',
        'condicion',
        'idpersona',
        'idtramite',
        'idestante',
        'idpasillo',
    ];
}
