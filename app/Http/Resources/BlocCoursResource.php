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
        return [
        'id'=>$this->id,
        'jour'=>$this->jour,
        'heures'=>$this->heures,
        'dure'=>$this->dure,
        'groupe_cours' => new GroupeCoursResource($this->groupecours),
        'local'=>new LocalResource($this->local),
        ];
    }
}
