<?php
/** @Author: Jean-Francois Gamache (Itération 2) */

namespace App\Http\Controllers;

use App\Http\Resources\LocalResource;
use App\Models\Horaire;
use App\Models\Local;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocalController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //Mettre la liste en ordre de numéro du local
        return $this->sendResponse(LocalResource::collection(Local::all()->sortBy('no_local')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->validateLocal($request);
        $local = Local::create([
            'no_local' => $request->no_local,
            'capacite' => $request->capacite,
            'local_technique' => $request->local_technique,
            'horaire_id' => Horaire::factory()->create()->id
        ]);
        $local->save();
        return $this->sendResponse(LocalResource::collection(Local::all()->sortBy('no_local')));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local): JsonResponse
    {
        $this->validateLocal($request);
        $local->update([
            'no_local' => $request->no_local,
            'capacite' => $request->capacite,
            'local_technique' => $request->local_technique,
        ]);
        $local->save();
        return $this->sendResponse(LocalResource::collection(Local::all()->sortBy('no_local')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local): JsonResponse
    {
        Local::destroy($local->id);
        $local->save();
        return $this->sendResponse(LocalResource::collection(Local::all()->sortBy('no_local')));
    }

    /**
     * Fonction qui permet de valider les données envoyées
     * @param Request $request
     * @return array
     */
    private function validateLocal(Request $request): array
    {
        return $request->validate([
            'no_local' => 'required',
            'capacite' => 'required|int|min:1|max:1000',
            'local_technique' => 'required|boolean'
            ]);
    }
}
