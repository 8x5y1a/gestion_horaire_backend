<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlocGenerauxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $jour = new JourResource($this->jour);

        return [
            'id'=>$this->id,
            'jour'=>$jour->nom,
            'heures'=>$this->heures,
            'dure'=>$this->dure,
            'bloc_libre'=>new BlocLibreResource($this->blocLibre)
        ];
    }
}
