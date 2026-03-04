<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contrainte extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'type_contrainte_id', 'type_description', 'stricte', 'session'];

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
    public function cours(): BelongsToMany{
        return $this->belongsToMany(Cours::class);
    }
    public function bloc_heures(): hasMany{
        return $this->hasMany(BlocHeure::class);
    }
    public function bloc_libres(): hasMany{
        return $this->hasMany(BlocLibre::class);
    }
    public function type_contrainte(): BelongsTo{
        return $this->belongsTo(TypeContrainte::class, 'type_contrainte_id');
    }
}
