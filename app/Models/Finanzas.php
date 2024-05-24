<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finanzas extends Model
{
    use HasFactory;
    use HasFactory;
    public $timestamps = false;
    protected $table="finanzas";
    protected $primaryKey="idempastado";
    protected $fillable = [
        'nrocomprabante',
    ];
}
