<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
/* @author: Fabrice Fortin */
class Personnel extends Model
{
    use HasFactory;
    protected $fillable =[
        'prenom',
        'nom',
        'bureau',
        'poste',
        'role',
        'horaire_id',
        'user_id',
        'adresse_courriel'
    ];

    public function horaire() : BelongsTo{
        return $this->belongsTo(Horaire::class, 'horaire_id');
    }
    public function abandon_horaire(){
        $this->horaire()->disassociate();
        $this->save();
    }
    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function abandon_user(){
        $this->user()->disassociate();
        $this->save();
    }
    public function contrainte(): BelongsToMany{
        return $this->belongsToMany(Contrainte::class);
    }
}
