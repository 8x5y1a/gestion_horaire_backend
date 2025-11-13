<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlocCoursResource;
use App\Models\BlocCours;
use App\Models\GroupeCours;
use App\Models\Local;
use Faker\Provider\Base;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlocCoursController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return $this->sendResponse(BlocCoursResource::collection(BlocCours::all()->sortBy('groupe_cours_id')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        $this->validate_bloc_cours($request);


        // Verification du campus
        $localId = $request->input('local_id');
        $local = Local::find($localId);
        if (!$local) {
            return $this->sendError('Local pas trouvé.', 404);
        }
        // Verification que le groupe cours existe
        $groupeCoursId = $request->input('groupe_cours_id');
        $groupeCours = GroupeCours::find($groupeCoursId);
        if (!$groupeCours) {
            return $this->sendError('Groupe cours non trouvé.', 404);
        }

        BlocCours::create([
            'jour' => $request->jour,
            'heures' => $request->heures,
            'dure' => $request->dure,
            'local_id'=>$localId,
            'groupe_cours_id'=>$groupeCoursId,
        ]);
        return $this->sendResponse(BlocCoursResource::collection(BlocCours::all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        // Trouve le bloc cours par le id
        $blocCours = BlocCours::find($id);

        // Vérification qu'un bloc cours à été trouvé.
        if (!$blocCours) {
            return $this->sendError('bloc cours pas trouvé.', 404);
        }

        // Retourne le bloc cours comme une resource JSON.
        return $this->sendResponse(new BlocCoursResource($blocCours));
    }

    /**
     * Fonction qui permet de modifier le bloc cours lorsqu'il est déplacé dans le gabarit d'horaire.
     */
    public function update(Request $request): JsonResponse
    {
        //Valider le bloc cours
        $this->validate_bloc_cours($request);
        $blocCours = BlocCours::find($request->id);

        if (!$blocCours) {
            return $this->sendError('Bloc cours pas trouvé.', 404);
        }

        //Récupérer le local et le modifier
        if($request->local){
            $local_id = $request->local['id'];
            $local = Local::find($local_id);
            if (!$local) {
                return $this->sendError('Local pas trouvé.', 404);
            }

            //Vérifier que le local existe et l'attribuer
            if(isset($local)){
                $blocCours->setLocal($local);
            }
        }
        //Si on le déplace vers la liste des cours technique
        else{
            $blocCours->local_id = null;
        }

        //Modifier le bloc cours envoyé en paramètre
        $blocCours->update([
            'jour' => $request->jour,
            'heures' => $request->heures,
            'dure'=> $request->dure,
        ]);

        return $this->sendResponse(BlocCoursResource::collection(BlocCours::all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $blocCours = BlocCours::find($id);

        if (!$blocCours) {
            return $this->sendError('Bloc cours pas trouvé.', 404);
        }

        BlocCours::destroy($id);
        return $this->sendResponse(BlocCoursResource::collection(BlocCours::all()));
    }


    private function validate_bloc_cours(Request $request): array
    {
        return $request->validate([
            'jour' => 'string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche,aucun',
            'heures' => 'string|size:10|regex:/^[01]{10}$/',
            'dure' => 'required|int|min:1|max:20',
        ]);
    }
}
