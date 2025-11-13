<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlocHeure extends Model
{
    use HasFactory;

    protected $fillable = ['jour', 'heures', 'contrainte_id'];

    public function contrainte(): BelongsTo{
        return $this->belongsTo(Contrainte::class, 'contrainte_id');
    }
}
