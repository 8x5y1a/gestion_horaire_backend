<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* @author: Fabrice Fortin */
class Horaire extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];

    public function local(){
        return $this->hasOne(Local::class);
    }

    public function personnel(){
        return $this->hasOne(Personnel::class);
    }

    public function cheminement(){
        return $this->hasOne(Cheminement::class);
    }
}
