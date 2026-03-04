<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Mathieu Lahaie-Richer
 */
class Cours extends Model
{
    use HasFactory;

    protected $fillable =['code','nom','ponderation','bloc','local_technique','cours_charge','session'];

    //Relation table groupe_cours
    public function groupecours(): HasMany{
        return $this->hasMany(GroupeCours::class);
    }

    //Relation table cheminements
    public function cheminement(): BelongsToMany{
        return $this->belongsToMany(Cheminement::class);
    }

    //Relation table sessions
    /*
         public function estEnseigne(){
        return $this->belongsTo(Session::class);
    }*/

    public function contraintes(): BelongsToMany{
        return $this->belongsToMany(Contrainte::class);
    }
}
