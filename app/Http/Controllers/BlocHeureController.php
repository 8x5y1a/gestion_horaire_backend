<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlocHeureResource;
use App\Models\BlocHeure;
use App\Models\Jour;
use Illuminate\Http\Request;

class BlocHeureController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(BlocHeure::class,'blocheure');
    }
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

        //Récupérer le jour
        $jour = Jour::all()->firstWhere('nom', $request->jour);

        //Ajouter le nouveau bloc d'heure à partir des données envoyées
        BlocHeure::create([
            'jour_id' => $jour->id,
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
    public function show(BlocHeure $blocheure): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(BlocHeure::find($blocheure->id));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour un bloc d'heure dans la base de données.
     */
    public function update(Request $request, BlocHeure $blocheure): \Illuminate\Http\JsonResponse
    {
        //Valider le bloc d'heure
        $this->validateBlocHeure($request);
        //Récupérer le bloc d'heure à modifier
        //Récupérer le jour
        $jour = Jour::all()->firstWhere('nom', $request->jour);
        if($blocheure) {
            //Modifier le bloc d'heure envoyé en paramètre
            $blocheure->update([
                'jour' => $jour->id,
                'heures' => $request->heures,
                'contrainte_id' => $request->contrainte_id
            ]);
            //Sauvergader le changement de données
            $blocheure->save();
            //Redirection
            return $this->sendResponse(BlocHeureResource::collection(BlocHeure::all()));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime un bloc d'heure de la base de données.
     */
    public function destroy(BlocHeure $blocheure): \Illuminate\Http\JsonResponse
    {
        //Supprimer le bloc d'heure dont l'ID envoyé en paramètre correspond
        BlocHeure::destroy($blocheure->id);
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
            'jour'=>'required|string|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Quotidien|exists:jours,nom',
            'heures'=>'required|string|regex:/^[01]{10}$/',
            'contrainte.id'=>'exists:contraintes,id',
        ]);
    }
}
