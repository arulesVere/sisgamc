<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="oficina";
    protected $primaryKey="idoficina";
    protected $fillable = [
        'nombre',
        'secretaria',
    ];
}
