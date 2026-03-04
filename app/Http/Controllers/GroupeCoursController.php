<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupeCoursResource;
use App\Models\BlocCours;
use App\Models\Campus;
use App\Models\Cours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Local;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\GroupeCours;
use Illuminate\Support\Facades\DB;

class GroupeCoursController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(GroupeCours::class,'groupecour');
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $groupeCours = GroupeCours::with('cours')
            ->join('cours', 'groupe_cours.cours_id', '=', 'cours.id')
            ->orderBy('cours.code')
            ->orderBy('groupe_cours.groupe')
            ->select('groupe_cours.*')
            ->get();

        return $this->sendResponse(GroupeCoursResource::collection($groupeCours));
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
        $enseignant = User::find($enseignantId);
        if (!$enseignant) {
            return $this->sendError('Enseignant pas trouvé.', 404);
        }

        // Verification que cours existe
        $coursId = $request->input('cour');
        $cours = Cours::find($coursId);
        if (!$cours) {
            return $this->sendError('Cours pas trouvé.', 404);
        }



        $nouveauGroupeCours = GroupeCours::create([
            'nbetud' => $request->nbetud,
            'couleur' => $request->couleur,
            'groupe' => $request->groupe,
            'cours_id'=>$cours->id,
            'user_id'=>$enseignant->id,
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
                    'jour_id'=>9,
                    'heures'=>'0000000000',
                    'dure'=>(int) $blocCours
                ]);
                $blocCours->setGroupeCours($nouveauGroupeCours);
            }
        }
        else{
            $blocCours = BlocCours::create([
                'groupe_cour_id'=>$nouveauGroupeCoursId,
                'local_id'=>null,
                'jour_id'=>9,
                'heures'=>'0000000000',
                'dure'=>(int) $bloc
            ]);
            $blocCours->setGroupeCours($nouveauGroupeCours);
        }
        $nouveauGroupeCours->save();
        return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()->sortBy('id')));
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupeCours $groupecour):JsonResponse
    {
        // Vérification qu'un groupe cours à été trouvé.
        if (!$groupecour) {
            return $this->sendError('Groupe cours pas trouvé.', 404);
        }

        // Retourne le groupe cours comme une resource.
        return $this->sendResponse(new GroupeCoursResource($groupecour));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,GroupeCours $groupecour):JsonResponse
    {
        $this->validateGroupe_cour($request);

        $groupeCours = GroupeCours::find($request->input('id'));

        // Verification du campus
        $campusId = $request->input('campus');
        $campus = Campus::find($campusId);
        if (!$campus) {
            return $this->sendError('Campus pas trouvé.',  404);
        }
        // Verification que professeur existe
        $enseignantId = $request->input('enseignant');
        $enseignant = User::find($enseignantId);
        if (!$enseignant) {
            return $this->sendError('Enseignant pas trouvé.', 404);
        }
        // Verification que cours existe
        $coursId = $request->input('cour');
        $cours = Cours::find($coursId);
        if (!$cours) {
            return $this->sendError('Cours pas trouvé.', 404);
        }
        //Vérifie si les éléments ont étés modifiés avant d'être changé.
        if($groupeCours->cours->id !== $cours->id){

            //////////////////////////////////
            /// METTRE À JOUR LES HORAIRES ///
            //////////////////////////////////

            //Récupérer tous les blocs cours appartenant au groupe cours
            $listeBlocCours = BlocCours::all()->where('groupe_cours_id', $groupeCours['id']);
            foreach ($listeBlocCours as $bloc) {
                //Récupérer le jour du bloc cours
                $jour = Jour::find($bloc['jour_id']);
                //Vérifier que le bloc cours est placé dans l'horaire
                if($jour['nom'] !== 'Aucun') {
                    //Récupérer l'horaire de l'utilisateur
                    $user = User::find($groupeCours['user_id']);
                    $horaireUser = Horaire::find($user['horaire_id']);
                    //Calculer l'horaire de l'utilisateur sans le bloc cours
                    $heureModifiee = '0000000000';
                    for ($i = 0; $i < 10; $i++) {
                        if ($bloc['heures'][$i] != 1 && $horaireUser[$jour['nom']][$i] == 1) {
                            $heureModifiee[$i] = 1;
                        }
                    }
                    //Mettre à jour l'horaire de l'utilisateur
                    $horaireUser->update([$jour['nom'] => $heureModifiee]);
                    //Récupérer l'horaire du local
                    $local = Local::find($bloc['local_id']);
                    if ($local != null) {
                        $horaireLocal = Horaire::find($local['horaire_id']);

                        //Calculer l'horaire du local sans le bloc cours
                        $heureModifiee = '0000000000';
                        for ($i = 0; $i < 10; $i++) {
                            if ($bloc['heures'][$i] != 1 && $horaireLocal[$jour['nom']][$i] == 1) {
                                $heureModifiee[$i] = 1;
                            }
                        }
                        //Mettre à jour l'horaire du local
                        $horaireLocal->update([$jour['nom'] => $heureModifiee]);

                    }
                    //Mettre à jour le bloc cours
                    $bloc->update(['heures' => '0000000000', 'local_id' => null]);
                    $horaireUser->save();
                    $horaireLocal->save();
                    $bloc->save();
                }
            }

            //Détruire les bloc_cours en lien avec l'ancien cours
            foreach ($groupeCours->bloccours as $bloc){
                $bloc = BlocCours::find($bloc->id);
                BlocCours::destroy($bloc->id);
            }

            $groupeCours->setCours($cours);
            $bloc = $cours->bloc; //la string qui indique le nombre de bloc cours
            $pattern = '/-/m';
            if (preg_match($pattern, $bloc)) {
                //Separe la string the bloc pour avoir une list de bloc qui ou chaque element est la durer
                $blocArray = explode('-', $bloc);

                foreach ($blocArray as $blocCours) {
                    $blocCours = BlocCours::create([
                        'groupe_cour_id' => $groupeCours->id,
                        'local_id' => null,
                        'jour_id' => 9,
                        'heures' => '0000000000',
                        'dure' => (int)$blocCours
                    ]);
                    $blocCours->setGroupeCours($groupeCours);
                }
            } else {
                $blocCours = BlocCours::create([
                    'groupe_cour_id' => $groupeCours->id,
                    'local_id' => null,
                    'jour_id' => 9,
                    'heures' => '0000000000',
                    'dure' => (int)$bloc
                ]);
                $blocCours->setGroupeCours($groupeCours);
            }
        }

        if($groupeCours->user->id !== $enseignant->id){
            $groupeCours->setEnseignant($enseignant);
        }

        if($groupeCours->campus->id !== $campus->id){
            $groupeCours->setCampus($campus);
        }

        $groupecour->update([
            'nbetud' => $request->nbetud,
            'groupe' => $request->groupe,
            'couleur' => $request->couleur,
        ]);
        $groupeCours->save();
        return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupeCours $groupecour):JsonResponse
    {
        $groupeCours = GroupeCours::find($groupecour->id);
        if (!$groupeCours) {
            return $this->sendError('Groupe cours introuvable.',404);
        }

        $coursId = $groupeCours->cours->id;
        $cours = Cours::find($coursId);

        if (!$cours) {
            return $this->sendError('Cours associé non trouvé.', 404);
        }
        //Récupérer tous les blocs cours appartenant au groupe cours
        $listeBlocCours = BlocCours::all()->where('groupe_cours_id', $groupeCours['id']);
        foreach ($listeBlocCours as $bloc) {
            //Récupérer le jour du bloc cours
            $jour = Jour::find($bloc['jour_id']);
            //Vérifier que le bloc cours est placé dans l'horaire
            if($jour['nom'] !== 'Aucun') {
                //Récupérer l'horaire de l'utilisateur
                $user = User::find($groupeCours['user_id']);
                $horaireUser = Horaire::find($user['horaire_id']);
                //Calculer l'horaire de l'utilisateur sans le bloc cours
                $heureModifiee = '0000000000';
                for ($i = 0; $i < 10; $i++) {
                    if ($bloc['heures'][$i] != 1 && $horaireUser[$jour['nom']][$i] == 1) {
                        $heureModifiee[$i] = 1;
                    }
                }
                //Mettre à jour l'horaire de l'utilisateur
                $horaireUser->update([$jour['nom'] => $heureModifiee]);
                //Récupérer l'horaire du local
                $local = Local::find($bloc['local_id']);
                if ($local != null) {
                    $horaireLocal = Horaire::find($local['horaire_id']);

                    //Calculer l'horaire du local sans le bloc cours
                    $heureModifiee = '0000000000';
                    for ($i = 0; $i < 10; $i++) {
                        if ($bloc['heures'][$i] != 1 && $horaireLocal[$jour['nom']][$i] == 1) {
                            $heureModifiee[$i] = 1;
                        }
                    }
                    //Mettre à jour l'horaire du local
                    $horaireLocal->update([$jour['nom'] => $heureModifiee]);

                }
                //Mettre à jour le bloc cours
                $bloc->update(['heures' => '0000000000', 'local_id' => null]);
                $horaireUser->save();
                $horaireLocal->save();
                $bloc->save();
            }
        }

        // Efface le groupe cours specifier
        try {
            DB::transaction(function () use ($groupeCours, $cours) {

                GroupeCours::destroy($groupeCours->id);
            });
            $groupeCours->save();
            return $this->sendResponse(GroupeCoursResource::collection(GroupeCours::all()));
        } catch (\Exception $e) {
            return $this->sendError('Erreur serveur.', ["error" => $e->getMessage()], 500);
        }
    }
    private function validateGroupe_cour(Request $request): array
    {
        return $request->validate([
            'nbetud' => 'required|int|min:3|max:200',
            'groupe' => 'required|int|min:1|max:50',
            'couleur' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'campus'=>'exists:campus,id',
            'cour'=>'exists:cours,id',
            'enseignant'=>'exists:users,id',
        ]);
    }

}
