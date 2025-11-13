<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupeCoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nbEtud' => $this->nbEtud,
            'groupe' => $this->groupe,
            'campus' => $this->campus,
            'cour' => $this->cours,
            'enseignant' => new PersonnelResource($this->personnel),
        ];
    }
}
