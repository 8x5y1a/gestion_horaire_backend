<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @author Louis-carl
 * @author Mathieu Lahaie-Richer correction
 */
class BlocCours extends Model
{
    use HasFactory;


    protected $fillable = [
        'jour_id',
        'heures',
        'dure',
        'groupe_cours_id',
        'local_id'
    ];

    public function groupecours(): BelongsTo{
        return $this->belongsTo(GroupeCours::class,'groupe_cours_id');
    }
    public function setGroupeCours(GroupeCours $groupeCours):void{
        $this->groupecours()->associate($groupeCours);
        $this->save();
    }
    public function removeGroupeCours():void{
        $this->groupecours()->disassociate();
        $this->save();
    }

    public function local(): BelongsTo{
        return $this->belongsTo(Local::class);
    }

    public function setLocal(Local $local):void{
        $this->local()->associate($local);
        $this->save();
    }
    public function removeLocal():void{

        $this->local()->disassociate();
        $this->save();
    }
    public function jour(): BelongsTo{
        return $this->belongsTo(Jour::class, 'jour_id');
    }

}
