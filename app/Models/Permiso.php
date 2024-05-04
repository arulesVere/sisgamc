<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="permiso";
    protected $primaryKey="idpermiso";
    protected $fillable = [
        'fecharegistro',
        'idpersona',
        'idrol',
    ];
}
