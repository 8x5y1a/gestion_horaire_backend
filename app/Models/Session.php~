<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Session extends Model
{
    use HasFactory;



    protected $fillable= [
        'annee',
        'session',
    ];

    /**
     * @return BelongsToMany
     * annee: l'anner
     *
     */

    public function groupe_cours(): BelongsToMany
    {
        return $this->belongsToMany(GroupeCours::class);
    }

    public function addGroupeCour(GroupeCours $groupe_cour):void
    {
        $groupe_cour->session_id = $this->id;
        $groupe_cour->save();

    }
    public function removeGroupeCour(GroupeCours $groupe_cour):void
    {
        $this->groupe_cour()->detach($groupe_cour);
    }

}
