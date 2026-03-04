<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlocLibreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'nb_bloc'=>$this->nb_bloc,
            'nb_heure'=>$this->nb_heure,
            'contrainte'=>$this->contrainte
        ];
    }
}
