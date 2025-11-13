<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mathieu Lahaie-Richer
 */
class Cheminement extends Model
{
    use HasFactory;

    protected $fillable =['nom','option','horaire_id'];

    //Relation pour la table cours
    public function cours(){
        return $this->belongsToMany(Cours::class);
    }

    //Relation pour la table contraintes
    public function contraintes(){
        return $this->belongsToMany(Contrainte::class);
    }

    //Relation pour la table horaire
    public function horaires(){
        return $this->belongsTo(Horaire::class,'horaire_id');
    }

    public function setHoraire($horaire_id){
        $this->horaires()->associate($horaire_id);
        $this->save();
    }

    public function delHoraire(){
        $this->horaires()->dissociate();
        $this->save();
    }




}
