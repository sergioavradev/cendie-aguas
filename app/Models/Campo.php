<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'tipo', 'formulario_id'];


    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }


    public function opciones()
    {
        return $this->hasMany(Opcion::class);
    }

    public function geolocalizacion()
    {
        return $this->hasOne(Geolocalizacion::class);
    }


}
