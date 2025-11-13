<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampusResource;
use App\Http\Resources\GroupeCoursResource;
use App\Models\Campus;
use App\Models\GroupeCours;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampusController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return $this->sendResponse(CampusResource::collection(Campus::all()->sortBy('id')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        // Trouvé le campus par le id
        $campus = Campus::find($id);

        // Vérification qu'un campus à été trouvé.
        if (!$campus) {
            return $this->sendError('Campus introuvable.', [], 404);
        }

        // Retourne le campus comme une ressources
        return $this->sendResponse(new CampusResource($campus));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
