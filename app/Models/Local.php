<?php
// @Author: Jean-François Gamache
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    use HasFactory;

    protected $table ='locaux';

    protected $fillable = [
        "no_local",
        "capacite",
        "local_technique",
        'horaire_id'
    ];

    public function horaire(): BelongsTo{
        return $this->belongsTo(Horaire::class, 'horaire_id');
    }
    public function bloc_cours(): HasMany {
        return $this->hasMany(BlocCours::class, 'bloc_cours_id');
    }
}
