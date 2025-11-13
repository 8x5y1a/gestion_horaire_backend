<?php

namespace App\Http\Resources;

use App\Http\Controllers\HoraireController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalResource extends JsonResource
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
            'no_local'=>$this->no_local,
            'capacite'=>$this->capacite,
            'local_technique'=>$this->local_technique,
            'horaire'=> $this->horaire,
        ];
    }
}
