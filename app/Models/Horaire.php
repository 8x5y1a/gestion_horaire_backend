<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/* @author: Fabrice Fortin */
class Horaire extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

    public function local(): HasOne{
        return $this->hasOne(Local::class);
    }

    public function user(): HasOne{
        return $this->hasOne(User::class);
    }

    public function cheminement(): HasOne{
        return $this->hasOne(Cheminement::class);
    }
}
