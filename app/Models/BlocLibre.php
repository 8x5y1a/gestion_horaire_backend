<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlocLibre extends Model
{
    use HasFactory;

    protected $fillable = ['nb_bloc', 'nb_heure', 'contrainte_id'];

    public function contrainte(): BelongsTo{
        return $this->belongsTo(Contrainte::class, 'contrainte_id');
    }
}
