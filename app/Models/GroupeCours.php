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

    protected $fillable = ['nbetud','groupe','cours_id','campus_id','user_id','couleur'];

    public function campus(): BelongsTo{
        return $this->belongsTo(Campus::class);
    }

    public function cours(): BelongsTo{
        return $this->belongsTo(Cours::class);
    }

    public function bloccours(): HasMany{
        return $this->hasMany(BlocCours::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function setEnseignant(User $user):void{
        $this->user()->associate($user);
        $this->save();
    }
    public function removeEnseignant():void{
        $this->user()->disassociate();
        $this->save();
    }

    public function setCours(Cours $cours):void{
        $this->cours()->associate($cours);
        $this->save();
    }
    public function removeCours():void{
        $this->cours()->disassociate();
        $this->save();
    }
    public function setCampus(Campus $campus):void{
        $this->campus()->associate($campus);
        $this->save();
    }
    public function removeCampus():void{
        $this->campus()->dissociate();
        $this->save();
    }





}
