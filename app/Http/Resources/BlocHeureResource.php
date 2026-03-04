<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlocHeureResource extends JsonResource
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
            'heures' => $this->heures,
            'jour'=>$jour->nom,
            'contrainte'=>$this->contrainte
        ];
    }
}
