<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoursResource;
use App\Models\BlocCours;
use App\Models\Cheminement;
use App\Models\Cours;
use App\Models\GroupeCours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Local;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/**
 * @author Mathieu Lahaie-Richer
 */
class CoursController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Cours::class,'cour');
    }
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

        $listeGroupeCours = GroupeCours::all()->where('cours_id',$cour->id);

        foreach ($listeGroupeCours as $groupeCours){
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
        }

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

        $listeGroupeCours = GroupeCours::all()->where('cours_id',$cour->id);

        foreach ($listeGroupeCours as $groupeCours){
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
        }

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
            'session'=>'required|int|in:1,2,3,4,5,6'
        ]);
    }
}
