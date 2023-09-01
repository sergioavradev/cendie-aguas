<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'id_padre'];
    protected $table = 'regiones';

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_region');
    }

    public function padre()
    {
        return $this->belongsTo(Region::class, 'id_padre');
    }

    public function hijos()
    {
        return $this->hasMany(Region::class, 'id_padre');
    }
    
}
