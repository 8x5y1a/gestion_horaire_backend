<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @author Mathieu Lahaie-Richer
 */
class Cheminement extends Model
{
    use HasFactory;

    protected $fillable =['nom','option','horaire_id'];

    //Relation pour la table cours
    public function cours(): BelongsToMany{
        return $this->belongsToMany(Cours::class);
    }


    //Relation pour la table horaire
    public function horaires(): BelongsTo{
        return $this->belongsTo(Horaire::class,'horaire_id');
    }

    public function setHoraire($horaire_id): void{
        $this->horaires()->associate($horaire_id);
        $this->save();
    }

    public function delHoraire(): void{
        $this->horaires()->dissociate();
        $this->save();
    }




}
