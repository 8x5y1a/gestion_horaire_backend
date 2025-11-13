<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlocHeureResource;
use App\Models\BlocHeure;
use Illuminate\Http\Request;

class BlocHeureController extends BaseController
{
    /**
     * @author Louis Peterlini
     * Méthode qui récupère la liste des blocs d'heure.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocHeureResource::collection(BlocHeure::all()));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui ajoute un bloc d'heure dans la base de données.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc d'heure
        $this->validateBlocHeure($request);
        //Ajouter le nouveau bloc d'heure à partir des données envoyées
        BlocHeure::create([
            'jour' => $request->jour,
            'heures' => $request->heures,
            'contrainte_id'=> $request->contrainte_id
        ]);
        //Redirection
        return $this->sendResponse(BlocHeureResource::collection(BlocHeure::all()), 201);

    }

    /**
     * @author Louis Peterlini
     * Méthode qui récupère un bloc heure en particulier.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocHeure::find($id));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour un bloc d'heure dans la base de données.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc d'heure
        $this->validateBlocHeure($request);
        //Récupérer le bloc d'heure à modifier
        $blocHeure = BlocHeure::find($id);
        if($blocHeure) {
            //Modifier le bloc d'heure envoyé en paramètre
            $blocHeure->update([
                'jour' => $request->jour,
                'heures' => $request->heures,
                'contrainte_id' => $request->contrainte_id
            ]);
            //Sauvergader le changement de données
            $blocHeure->save();
            //Redirection
            return $this->sendResponse(BlocHeureResource::collection(BlocHeure::all()));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime un bloc d'heure de la base de données.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        //Supprimer le bloc d'heure dont l'ID envoyé en paramètre correspond
        BlocHeure::destroy($id);
        //Redirection
        return $this->sendResponse(BlocHeureResource::collection(BlocHeure::all()));
    }
    /**
     * @author Louis Peterlini
     * Méthode qui valide les données envoyées dans la requête.
     * @param Request $request La requête qui contient les données à valider.
     * @return array Le résultat de la validation.
     */
    private function validateBlocHeure(Request $request): array{

        return $request->validate([
            'jour'=>'required|string|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi',
            'heures'=>'required|string|regex:/^[01]{10}$/',
        ]);
    }
}
