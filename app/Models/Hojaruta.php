<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hojaruta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="hojaruta";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'placa',
        'nroform',
        'motivo',
        'aquien',
        'adonde',
    ];
}
