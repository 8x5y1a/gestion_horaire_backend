<?php
/** @Author: Jean-Francois Gamache (Itération 2) */

namespace App\Http\Controllers;

use App\Http\Resources\LocalResource;
use App\Models\BlocCours;
use App\Models\GroupeCours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Local;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocalController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Local::class);
    }
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
        //Récupérer tous les blocs cours enregistrés dans le local
        $listeBlocCours = BlocCours::all()->where('local_id', $local['id']);
        foreach ($listeBlocCours as $bloc){

            //Récupérer le jour du bloc cours
            $jour = Jour::find($bloc['jour_id']);
            //Récupérer l'horaire de l'utilisateur
            $groupeCours = GroupeCours::find($bloc['groupe_cours_id']);

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
            //Mettre à jour le bloc cours
            $bloc->update(['heures' => '0000000000', 'local_id' => null]);

            $horaireUser->save();
            $bloc->save();
        }
        //Vider l'horaire du local
        $local->horaire()->update([
            'Lundi' => '0000000000',
            'Mardi' => '0000000000',
            'Mercredi' => '0000000000',
            'Jeudi' => '0000000000',
            'Vendredi' => '0000000000'
            ]);
        $local->save();
        //Supprimer le local
        $local->delete();

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
            'no_local' => 'required|max:50', //Aucun regex car il a été mentionné que le local pourrait être n'importe quoi
            'capacite' => 'required|int|min:1|max:1000',
            'local_technique' => 'required|boolean'
            ]);
    }
}
