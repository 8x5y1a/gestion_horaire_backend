<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campus extends Model
{
    protected $table = 'campus';
    public $timestamps = false;
    protected $fillable= [
        'nom',
    ];



    /**
     * Campus: represente le campus que le cour va se passer.
     * nom: le nom du campus.
     */
    public function groupe_cour():BelongsToMany{
        return $this->belongsToMany(GroupeCours::class);
    }

    public function addGroupeCour(GroupeCours $groupe_cour):void {

        $groupe_cour->campus_id = $this->id;
        $groupe_cour->save();
    }

    public function removeGroupeCour(GroupeCours $Groupe_cour):void {
        $this->groupe_cour()->detach($Groupe_cour);
    }

}
