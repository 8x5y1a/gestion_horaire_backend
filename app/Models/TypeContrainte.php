<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeContrainte extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function contraintes(): hasMany{
        return $this->hasMany(Contrainte::class);
    }
}
