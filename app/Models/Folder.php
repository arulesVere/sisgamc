<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="folder";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'codigo',
        'numero',
        'fechainicio',
        'fechafin',
        'nrohoja',
        'carnet',
        'solicitante',
        'idgestion',
        'idtramite',
        'idpersona',
        'idestante',
    ];
}
