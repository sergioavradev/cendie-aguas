<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    public function campos()
    {
        return $this->hasMany(Campo::class);
    }
}
