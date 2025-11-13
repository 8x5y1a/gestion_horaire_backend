<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoursResource;
use App\Models\Cheminement;
use App\Models\Cours;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/**
 * @author Mathieu Lahaie-Richer
 */
class CoursController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        //
        return $this->sendResponse(CoursResource::collection(Cours::all()->sortBy('code')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        $this->validationCours($request);
        $cours = Cours::create([
            'code'=>$request->code,
            'nom'=>$request->nom,
            'ponderation'=>$request->ponderation,
            'bloc'=>$request->bloc,
            'local_technique'=>$request->local_technique,
            'cours_charge'=>$request->cours_charge,
            'session'=>$request->get('session'),
        ]);
        foreach ($request->cheminement as $id){
            $setCheminement = Cheminement::find($id);
            $cours->cheminement()->attach($setCheminement);
        }
        $cours->save();
        return $this->sendResponse(CoursResource::collection(Cours::all()->sortBy('code')));
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
    public function update(Request $request, Cours $cour): JsonResponse
    {
        //Cours pas de "s" ici
        $this->validationCours($request);
        $cour->update([
            'code'=>$request->code,
            'nom'=>$request->nom,
            'ponderation'=>$request->ponderation,
            'bloc'=>$request->bloc,
            'local_technique'=>$request->local_technique,
            'cours_charge'=>$request->cours_charge,
            'session'=>$request->get('session'),
        ]);
        //Détache tous les liens
        $cour->cheminement()->detach();
        //Attache les cheminements avec cours
        foreach ($request->cheminement as $id ){
            $setCheminement = Cheminement::find($id);
            $cour->cheminement()->attach($setCheminement);
        }
        $cour->save();
        return $this->sendResponse(CoursResource::collection(Cours::all()->sortBy('code')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cour): JsonResponse
    {
        //Cours pas de "s" ici
       Cours::destroy($cour->id);
       $cour->save();
        return $this->sendResponse(CoursResource::collection(Cours::all()->sortBy('code')));
    }

    private function validationCours(Request $request):array
    {
        return $request->validate([
            //Les noms des propriétés sont celles de la requêt http et non celles de la base de données
            'code'=>'required|String',
            'nom'=>'required|String',
            'ponderation'=>'required|String|regex:/(^\d{1}\-\d{1}-\d{1}$)/u',
            'bloc'=>'required|String',
            'local_technique'=>'required|boolean',
            'cours_charge'=>'required|boolean',
            'session'=>'required'
        ]);
    }
}
