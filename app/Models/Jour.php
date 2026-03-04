<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jour extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function blocHeure(): hasMany{
        return $this->hasMany(BlocHeure::class);
    }
    public function bloc_cours(): hasMany{
        return $this->hasMany(BlocCours::class);
    }
    public function bloc_generaux(): hasMany{
        return $this->hasMany(BlocGeneraux::class);
    }
}
