<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @Author Jean-Francois Gamache | Iteration 3
 *
 */

class BlocGeneraux extends Model
{
    use HasFactory;

    protected $table ='bloc_generaux';

    protected $fillable = [
        'jour_id',
        'heures',
        'dure',
        'bloc_libre_id'
    ];

    public function blocLibre(): BelongsTo{
        return $this->belongsTo(BlocLibre::class, 'bloc_libre_id');
    }
    public function jour(): BelongsTo{
        return $this->belongsTo(Jour::class, 'jour_id');
    }
}
