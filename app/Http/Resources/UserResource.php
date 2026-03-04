<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'bureau' => $this->bureau,
            'poste' => $this->poste,
            'role' =>RoleResource::collection($this->role),
            'email' => $this->email,
            'horaire' =>new HoraireResource($this->horaire)
        ];
    }
}
