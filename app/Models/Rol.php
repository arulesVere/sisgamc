<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="rol";
    protected $primaryKey="idrol";
    protected $fillable = [
        'nombre',
        'detalle',

    ];
}
