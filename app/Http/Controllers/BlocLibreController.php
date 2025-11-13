<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlocLibreResource;
use App\Models\BlocLibre;
use App\Models\Contrainte;
use Illuminate\Http\Request;

class BlocLibreController extends BaseController
{
    /**
     * @author Louis Peterlini
     * Méthode qui récupère la liste des blocs libres.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui ajoute un bloc libre dans la base de données.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc libre
        $this->validateBlocLibre($request);
        //Ajouter le nouveau bloc libre à partir des données envoyées
        BlocLibre::create([
            'nb_bloc' => $request->nb_bloc,
            'nb_heure' => $request->nb_heure,
            'contrainte_id'=> $request->contrainte_id
        ]);
        //Redirection
        return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()), 201);

    }

    /**
     * @author Louis Peterlini
     * Méthode qui récupère un bloc libre en particulier.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocLibre::find($id));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour un bloc libre dans la base de données.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc libre
        $this->validateBlocLibre($request);
        //Récupérer le bloc libre à modifier
        $blocLibre = BlocLibre::find($id);
        if($blocLibre) {
            //Modifier le bloc libre envoyé en paramètre
            $blocLibre->update([
                'nb_bloc' => $request->nb_bloc,
                'nb_heure' => $request->nb_heure,
                'contrainte_id' => $request->contrainte_id
            ]);
            //Sauvergader le changement de données
            $blocLibre->save();
            //Redirection
            return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime un bloc libre de la base de données.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        //Supprimer le bloc libre dont l'ID envoyé en paramètre correspond
        BlocLibre::destroy($id);
        //Redirection
        return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()));
    }
    /**
     * @author Louis Peterlini
     * Méthode qui valide les données envoyées dans la requête.
     * @param Request $request La requête qui contient les données à valider.
     * @return array Le résultat de la validation.
     */
    private function validateBlocLibre(Request $request): array{

        return $request->validate([
            'nb_bloc'=>'required|integer|min:1',
            'nb_heure'=>'required|integer|min:1'
        ]);
    }
}
