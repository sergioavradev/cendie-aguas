<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocalizaciones extends Model
{
    use HasFactory;

    public function campo()
    {
        return $this->belongsTo(Campo::class);
    }
}
