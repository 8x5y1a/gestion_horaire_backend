<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupeCoursResource;
use App\Models\BlocCours;
use App\Models\Campus;
use App\Models\Cours;
use App\Models\Personnel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\GroupeCours;
use Illuminate\Support\Facades\DB;

class GroupeCoursController extends BaseController
{


    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()->sortBy('id')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {

        $this->validateGroupe_cour($request);


        // Verification du campus
        $campusId = $request->input('campus');
        $campus = Campus::find($campusId);
        if (!$campus) {
            return $this->sendError('Campus pas trouvé.',  404);
        }
        // Verification que professeur existe
        $enseignantId = $request->input('enseignant');
        $enseignant = Personnel::find($enseignantId);
        if (!$enseignant) {
            return $this->sendError('Enseignant pas trouvé.', 404);
        }

        // Verification que cours existe
        $coursId = $request->input('cour');
        $cours = Cours::find($coursId);
        if (!$cours) {
            return $this->sendError('Cours pas trouvé.', 404);
        }

        $maxGroupe = GroupeCours::where('cours_id', $coursId)->max('groupe');
        $nextGroupe = $maxGroupe ? $maxGroupe + 1 : 1;

        $nouveauGroupeCours = GroupeCours::create([
            'nbEtud' => $request->nbetud,
            'groupe' => $nextGroupe,
            'cours_id'=>$cours->id,
            'personnel_id'=>$enseignant->id,
            'campus_id'=>$campus->id,
        ]);

        $nouveauGroupeCoursId = $nouveauGroupeCours->id;

        $bloc = $cours->bloc; //la string qui indique le nombre de bloc cours

        $pattern = '/-/m';

        //Separe la string the bloc pour avoir une list de bloc qui ou chaque element est la durer
        if(preg_match($pattern,$bloc)){
            $blocArray = explode('-',$bloc);

            foreach ($blocArray as $blocCours) {
                $blocCours = BlocCours::create([
                    'groupe_cour_id'=>$nouveauGroupeCoursId,
                    'local_id'=>null,
                    'jour'=>'aucun',
                    'heure'=>'0000000000',
                    'dure'=>(int) $blocCours
                ]);
                $blocCours->setGroupeCours($nouveauGroupeCours);
            }
        }
        else{
            $blocCours = BlocCours::create([
                'groupe_cour_id'=>$nouveauGroupeCoursId,
                'local_id'=>null,
                'jour'=>'aucun',
                'heure'=>'0000000000',
                'dure'=>(int) $bloc
            ]);
            $blocCours->setGroupeCours($nouveauGroupeCours);
        }
        return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()->sortBy('groupe')));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        // Trouve le groupe cours par le id
        $groupeCours = GroupeCours::find($id);

        // Vérification qu'un groupe cours à été trouvé.
        if (!$groupeCours) {
            return $this->sendError('Groupe cours pas trouvé.', 404);
        }

        // Retourne le groupe cours comme une resource.
        return $this->sendResponse(new GroupeCoursResource($groupeCours));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id):JsonResponse
    {
        $this->validateGroupe_cour($request);

        // Verification de l'enseignant
        $enseignantId = $request->input('personnel_id');
        $enseignant = Personnel::find($enseignantId);
        if (!$enseignant) {
            return $this->sendError('enseignant introuvable.', 404);
        }


        $groupeCours = GroupeCours::find($id);

        $groupeCours->update([
            'nbEtud' => $request->nbetud,
        ]);

        $groupeCours->setEnseignant($enseignant);
        return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        $groupeCours = GroupeCours::find($id);

        if (!$groupeCours) {
            return $this->sendError('Groupe cours introuvable.',404);
        }
        $coursId = $groupeCours->cours_id;
        $cours = Cours::find($coursId);



        if (!$cours) {
            return $this->sendError('Cours associer non trouver.', 404);
        }

        // Efface le groupe cours specifier
        try {
            DB::transaction(function () use ($groupeCours, $cours) {
                $groupeCours->delete();

                // Trouve toutes les groupe cours avec le meme cours
                $otherGroupeCours = GroupeCours::where('cours_id', $cours->id)
                    ->where('groupe', '>', $groupeCours->groupe) // affect seulement les groupe plus haut
                    ->orderBy('groupe', 'asc')
                    ->get();

                foreach ($otherGroupeCours as $other) {
                    $other->decrement('groupe'); // soustrait 1 a toute les groupe.
                }
            });
            return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()));
        } catch (\Exception $e) {
            return $this->sendError('Erreur serveur.', ["error" => $e->getMessage()], 500);
        }
    }
    private function validateGroupe_cour(Request $request): array
    {
        return $request->validate([
            'nbetud' => 'required|int|min:3|max:200',
        ]);

    }

}
