<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duplicado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="duplicado";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'placa',
        'vehiculo',
        'tipoplaqueta',
        'plaqueta',
    ];
}
