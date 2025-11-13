<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupeCours extends Model
{
    use HasFactory;

    protected $fillable = ['nbEtud','groupe','cours_id','campus_id','personnel_id'];

    public function campus(): BelongsTo{
        return $this->belongsTo(Campus::class);
    }

    public function cours(): BelongsTo{
        return $this->belongsTo(Cours::class);
    }

    public function bloccours(): HasMany{
        return $this->hasMany(BlocCours::class);
    }

    public function personnel(): BelongsTo{
        return $this->belongsTo(Personnel::class);
    }

    public function setEnseignant(Personnel $personnel):void{
        $this->personnel()->associate($personnel);
        $this->save();
    }
    public function removeEnseignant():void{

        $this->personnel()->disassociate();
        $this->save();
    }



}
