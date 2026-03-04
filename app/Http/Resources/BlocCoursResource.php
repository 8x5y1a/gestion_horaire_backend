<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlocCoursResource extends JsonResource
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
        'groupe_cours' => new GroupeCoursResource($this->groupecours),
        'local'=>new LocalResource($this->local),
        ];
    }
}
