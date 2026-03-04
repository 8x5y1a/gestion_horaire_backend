<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlocLibreResource;
use App\Models\BlocGeneraux;
use App\Models\BlocLibre;
use App\Models\Contrainte;
use Illuminate\Http\Request;

class BlocLibreController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(BlocLibre::class,'bloclibre');
    }
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

        $this->gererLiaisons($request, BlocLibre::all()->last(), false);

        //Redirection
        return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()), 201);

    }

    /**
     * @author Louis Peterlini
     * Méthode qui récupère un bloc libre en particulier.
     */
    public function show(BlocLibre $bloclibre): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocLibre::find($bloclibre->id));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour un bloc libre dans la base de données.
     */
    public function update(Request $request, BlocLibre $bloclibre): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc libre
        $this->validateBlocLibre($request);
        //Récupérer le bloc libre à modifier
        if($bloclibre) {
            //Modifier le bloc libre envoyé en paramètre
            $bloclibre->update([
                'nb_bloc' => $request->nb_bloc,
                'nb_heure' => $request->nb_heure,
                'contrainte_id' => $request->contrainte_id
            ]);
            //Sauvergader le changement de données
            $bloclibre->save();

            $this->gererLiaisons($request, $bloclibre, true);

            //Redirection
            return $this->sendResponse(BlocLibreResource::collection(BlocLibre::all()));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime un bloc libre de la base de données.
     */
    public function destroy(BlocLibre $bloclibre): \Illuminate\Http\JsonResponse
    {
        //Supprimer le bloc libre dont l'ID envoyé en paramètre correspond
        BlocLibre::destroy($bloclibre->id);
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
            'nb_bloc'=>'required|integer|min:1|max:5',
            'nb_heure'=>'required|integer|min:1|max:5',
            'contrainte.id'=>'exists:contraintes,id',
        ]);
    }

    /**
     * @Author: Méthode faite par Louis Peterlini dans ContrainteController, adapté par JeanFrancois Gamache dans BlocLibre
     * Méthode qui gère les liaisons d'objets de BlocLibre en ajoutant ou modifiant celles-ci
     * selon le cas.
     * @param Request $request La requête contenant les données à ajouter ou modifier.
     * @param BlocLibre $blocLibre Le blocLibre sur laquelle les liaisons s'appliqueront.
     * @param bool $isModifier Booléen pour déterminer si on veut ajouter ou modifier les liaisons.
     */
    private function gererLiaisons(Request $request, BlocLibre $blocLibre, bool $isModifier): void{

        //Si on modifie le blocLibre: Supprimer tous les blocGénéraux associés
        if($isModifier){
            $lsBlocGeneraux = BlocGeneraux::all()->where('bloc_libre_id', $blocLibre['id']);
            foreach ($lsBlocGeneraux as $blocGeneraux){
                BlocGeneraux::destroy($blocGeneraux);
            }
        }

        //Créer tous les blocs généraux pour le nombre de blocs désirés
        for ($index = 0; $request->nb_bloc > $index; $index++ ){
            BlocGeneraux::create([
                'jour_id' => 9,
                'heures' => '0000000000',
                'dure' => $request->dure,
                'bloc_libre_id' => $blocLibre['id']
            ]);
        }
    }
}
