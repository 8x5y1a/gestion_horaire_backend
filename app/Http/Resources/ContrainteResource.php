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
        $typeContrainte = new TypeContrainteRessource($this->type_contrainte);

        return [
            'id'=>$this->id,
            'nom'=>$this->nom,
            'description'=>$this->description,
            'type'=>$typeContrainte->nom,
            'precision'=>$this->type_description,
            'stricte'=>$this->stricte,
            'session'=>$this->session,
            'enseignants'=>UserResource::collection($this->users),
            'cours'=>$this->cours,
            'ls_blocs_heures'=>BlocHeureResource::collection($this->bloc_heures),
            'ls_blocs_libres'=>$this->bloc_libres,
        ];
    }
}
