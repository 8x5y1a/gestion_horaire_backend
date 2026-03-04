<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheminementResource;
use App\Models\Cheminement;
use App\Models\Contrainte;
use App\Models\Cours;
use App\Models\Horaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/**
 * @author Mathieu Lahaie-Richer
 */
class CheminementController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Cheminement::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        return $this->sendResponse(CheminementResource::collection(Cheminement::all()->sortBy('nom')));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        $this->validationCheminement($request);
        $cheminement = Cheminement::create([
            'nom'=>$request->nom,
            'option'=>$request->option,
            'horaire_id' => Horaire::factory()->create()->id
        ]);
        $cheminement->cours()->detach();

        foreach ($request->cours as $cours ){
            $setCours = Cours::find($cours);
            $cheminement->cours()->attach($setCours);
        }
        $cheminement->save();
        return $this->sendResponse(CheminementResource::collection(Cheminement::all()->sortBy('nom')));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cheminement $cheminement): JsonResponse
    {
        //
        $this->validationCheminement($request);
        $cheminement->update([
            'nom'=>$request->nom,
            'option'=>$request->option
        ]);
        $cheminement->cours()->detach();
        foreach ($request->cours as $cours ){
            $setCours = Cours::find($cours);
            $cheminement->cours()->attach($setCours);
        }

        $cheminement->save();
        return $this->sendResponse(CheminementResource::collection(Cheminement::all()->sortBy('nom')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cheminement $cheminement):JsonResponse
    {
        //
        Cheminement::destroy($cheminement->id);
        $cheminement->save();
        return $this->sendResponse(CheminementResource::collection(Cheminement::all()->sortBy('nom')));
    }

    private function validationCheminement(Request $request):array
    {
        return $request->validate([
            //Les noms des propriétés sont celles de la requêt http et non celles de la base de données
            'nom'=>'required|String',
            'option'=>'required|String',
        ]);
    }
}
