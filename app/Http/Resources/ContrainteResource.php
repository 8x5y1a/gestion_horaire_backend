<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContrainteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'nom'=>$this->nom,
            'description'=>$this->description,
            'type'=>$this->type,
            'stricte'=>$this->stricte,
            'session'=>$this->session,
            'enseignants'=>$this->personnels,
            'cours'=>$this->cours,
            'ls_blocs_heures'=>$this->bloc_heures,
            'ls_blocs_libres'=>$this->bloc_libres,
        ];
    }
}
