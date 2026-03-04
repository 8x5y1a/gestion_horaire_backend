<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlocGenerauxResource;
use App\Models\BlocGeneraux;
use App\Models\Jour;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @Author Jean-Francois Gamache | Iteration 3
 */
class BlocGenerauxController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(BlocGeneraux::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return $this->sendResponse(BlocGenerauxResource::collection(BlocGeneraux::all()->sortBy('bloc_libre_id')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $this->validate_bloc_generaux($request);

        //Récupérer le jour
        $jour = Jour::all()->firstWhere('nom', $request->jour);

        BlocGeneraux::create([
            'jour_id' => $jour->id,
            'heures' => $request->heures,
            'dure' => $request->dure,
            'bloc_libre_id' => $request->bloc_libre_id
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlocGeneraux $blocGeneraux): void
    {
        $this->validate_bloc_generaux($request);
        //Récupérer le jour
        $jour = Jour::all()->firstWhere('nom', $request->jour);

        $blocGeneraux->update([
            'jour_id' => $jour->id,
            'heures' => $request->heures,
            'dure'=> $request->dure,
        ]);
        $blocGeneraux->save();
    }

    /**
     * @Author: Jean-François Gamache | Itération 3
     * Fonction qui permet de valider les blocs généraux.
     * @param Request $request
     * @return array
     */
    private function validate_bloc_generaux(Request $request): array
    {
        return $request->validate([
            'jour' => 'string|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi,Dimanche,Aucun|exists:jours,nom',
            'bloc_libre_id' => 'exists:bloc_libres,id',
            'heures' => 'string|size:10|regex:/^[01]{10}$/',
            'dure' => 'required|int|min:1|max:8',
        ]);
    }
}
