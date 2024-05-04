<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="cargo";
    protected $primaryKey="idcargo";
    protected $fillable = [
        'nombre',
        'detalle',
    ];
}
