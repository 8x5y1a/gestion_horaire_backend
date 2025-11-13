<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursResource extends JsonResource
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
            'nom' => $this->nom,
            'code' => $this->code,
            'ponderation' => $this->ponderation,
            'bloc' => $this->bloc,
            'local_technique' => $this->local_technique,
            'cours_charge' => $this->cours_charge,
            'session' => $this->session,
            'cheminement' => CheminementResource::collection($this->cheminement),
        ];
    }
}
