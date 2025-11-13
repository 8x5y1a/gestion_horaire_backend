<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContrainteResource;
use App\Models\BlocHeure;
use App\Models\BlocLibre;
use App\Models\Contrainte;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class ContrainteController extends BaseController
{
    /**
     * @author Louis Peterlini
     * Méthode qui récupère la liste des contraintes.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type')));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui ajoute une contrainte dans la base de données.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //Valider la contrainte
        $this->validateContrainte($request);
        //Créer la nouvelle contrainte à partir des données envoyées
        Contrainte::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'type'=> $request->type,
            'stricte'=> $request->stricte,
            'session'=> $request->get('session')
        ]);
        //Ajouter les liaisons entres les Enseignants, Cours, BlocHeures et BlocLibres
        $this->gererLiaisons($request, Contrainte::all()->last());
        //Redirection
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type')), 201);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui récupère une contrainte en particulier.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(new ContrainteResource(Contrainte::findOrFail($id)));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour une contrainte dans la base de données.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        //Valider la contrainte
        $this->validateContrainte($request);
        //Récupérer la contrainte à modifier
        $contrainte = Contrainte::find($id);
        if($contrainte) {
            //Modifier la contrainte envoyée en paramètre
            $contrainte->update([
                'nom' => $request->nom,
                'description' => $request->description,
                'type' => $request->type,
                'stricte' => $request->stricte,
                'session' => $request->get('session'),
            ]);
            //Modifier les liaisons entres les Enseignants, Cours, BlocHeures et BlocLibres
            $this->gererLiaisons($request, $contrainte, true);
            //Sauvegarder le changement de données
            $contrainte->save();
            //Redirection
            return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type')));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime une contrainte de la base de données.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        //Supprimer la contrainte dont l'ID envoyé en paramètre correspond
        Contrainte::destroy($id);
        //Redirection
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type')));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui valide les données envoyées dans la requête.
     * @param Request $request La requête qui contient les données à valider.
     * @return array Le résultat de la validation.
     */
    private function validateContrainte(Request $request): array{

        return $request->validate([
            'nom'=>'required|string|max:50',
            'description'=>'required|string|max:500',
            'type'=>'required|string|max:50',
            'stricte'=>'required|boolean',
            'session'=>'required_if:type,generaux|integer|min:0|max:6'
        ]);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui gère les liaisons d'objets de Contrainte en ajoutant ou modifiant celles-ci
     * selon le cas.
     * @param Request $request La requête contenant les données à ajouter ou modifier.
     * @param Contrainte $contrainte La contrainte sur laquelle les liaisons s'appliqueront.
     * @param bool $isModifier Booléen pour déterminer si on veut ajouter ou modifier les liaisons.
     */
    private function gererLiaisons(Request $request, Contrainte $contrainte, bool $isModifier = false): void{
        //Récupérer les listes des éléments envoyés dans la requête
        $lsEnseignantsId = $request->enseignants;
        $lsCoursId = $request->cours;
        $lsBlocsHeures = $request->ls_blocs_heures;
        $lsBlocsLibres = $request->ls_blocs_libres;

        //Vérifier que la liste des enseignants existe
        if($lsEnseignantsId) {
            if($isModifier) {
                //Détacher tous les enseignants de la contrainte
                $contrainte->personnels()->detach();
            }
            foreach ($lsEnseignantsId as $id) {
                //Lier l'enseignant à la contrainte
                $contrainte->personnels()->attach($id);
            }

        }
        //Vérifier que la liste des cours existe
        if($lsCoursId) {
            if($isModifier) {
                //Détacher tous les cours de la contrainte
                $contrainte->cours()->detach();
            }
            foreach ($lsCoursId as $id) {
                //Lier le cours à la contrainte
                $contrainte->cours()->attach($id);
            }
        }
        //Supprimer tous les blocs existant sur la contrainte si on modifie
        if($isModifier) {
            //Récupérer la liste de tous les blocs heures déjà associés à la contrainte
            $lsCompleteBlocHeure = BlocHeure::all()->where('contrainte_id', $contrainte['id']);
            //Récupérer la liste de tous les blocs libres déjà associés à la contrainte
            $lsCompleteBlocLibre = BlocLibre::all()->where('contrainte_id', $contrainte['id']);
            //Supprimer tous les blocs heures associés à la contrainte
            if ($lsCompleteBlocHeure) {
                foreach ($lsCompleteBlocHeure as $blocHeure) {
                    BlocHeure::destroy($blocHeure['id']);
                }
            }
            //Supprimer tous les blocs libres associés à la contrainte
            if ($lsCompleteBlocLibre) {
                foreach ($lsCompleteBlocLibre as $blocLibre) {
                    BlocLibre::destroy($blocLibre['id']);
                }
            }
        }
        //Vérifier que la liste des blocs d'heures existe
        if($lsBlocsHeures) {
            foreach ($lsBlocsHeures as $bloc) {
                //Créer le bloc d'heure
                BlocHeure::create([
                    'jour'=>$bloc['jour'],
                    'heures'=>$bloc['heures'],
                    'contrainte_id'=>$contrainte['id']
                ]);
            }
        }
        //Vérifier que la liste des blocs libres existe
        if($lsBlocsLibres) {
            foreach ($lsBlocsLibres as $bloc) {
                //Créer le bloc libre
                BlocLibre::create([
                    'nb_bloc'=>$bloc['nb_bloc'],
                    'nb_heure'=>$bloc['nb_heure'],
                    'contrainte_id'=>$contrainte['id']
                ]);
            }
        }
    }
}
