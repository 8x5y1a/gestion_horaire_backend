<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlocHeure extends Model
{
    use HasFactory;

    protected $fillable = ['jour_id', 'heures', 'contrainte_id'];

    public function contrainte(): BelongsTo{
        return $this->belongsTo(Contrainte::class, 'contrainte_id');
    }
    public function jour(): BelongsTo{
        return $this->belongsTo(Jour::class, 'jour_id');
    }
}
