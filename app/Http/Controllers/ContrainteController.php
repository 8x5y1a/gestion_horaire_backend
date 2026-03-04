<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContrainteResource;
use App\Http\Resources\TypeContrainteRessource;
use App\Models\BlocGeneraux;
use App\Models\BlocHeure;
use App\Models\BlocLibre;
use App\Models\Contrainte;
use App\Models\Jour;
use App\Models\TypeContrainte;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class ContrainteController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Contrainte::class);
    }
    /**
     * @author Louis Peterlini
     * Méthode qui récupère la liste des contraintes.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type_contrainte_id')));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui ajoute une contrainte dans la base de données.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //Valider la contrainte
        $this->validateContrainte($request);
        //Récupérer le type de contrainte
        $typeContrainte = TypeContrainte::all()->firstWhere('nom', $request->type);
        //Créer la nouvelle contrainte à partir des données envoyées
        Contrainte::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'type_contrainte_id'=> $typeContrainte->id,
            'type_description'=> $request->precision,
            'stricte'=> $request->stricte,
            'session'=> $request->get('session')
        ]);
        //Ajouter les liaisons entres les Enseignants, Cours, BlocHeures et BlocLibres
        $this->gererLiaisons($request, Contrainte::all()->last());
        //Redirection
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type_contrainte_id')), 201);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui récupère une contrainte en particulier.
     */
    public function show(Contrainte $contrainte): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(new ContrainteResource(Contrainte::findOrFail($contrainte->id)));
    }

    /**
     * @author Louis Peterlini
     * Méthode qui met à jour une contrainte dans la base de données.
     */
    public function update(Request $request, Contrainte $contrainte): \Illuminate\Http\JsonResponse
    {
        //Valider la contrainte
        $this->validateContrainte($request);
        //Récupérer le type de contrainte
        $typeContrainte = TypeContrainte::all()->firstWhere('nom', $request->type);
        //Récupérer la contrainte à modifier
        if($contrainte) {
            //Modifier la contrainte envoyée en paramètre
            $contrainte->update([
                'nom' => $request->nom,
                'description' => $request->description,
                'type_contrainte_id'=> $typeContrainte->id,
                'type_description'=> $request->precision,
                'stricte' => $request->stricte,
                'session' => $request->get('session'),
            ]);
            //Modifier les liaisons entres les Enseignants, Cours, BlocHeures et BlocLibres
            $this->gererLiaisons($request, $contrainte, true);
            //Sauvegarder le changement de données
            $contrainte->save();
            //Redirection
            return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type_contrainte_id')));
        }
        return $this->sendResponse('', 404);
    }

    /**
     * @author Louis Peterlini
     * Méthode qui supprime une contrainte de la base de données.
     */
    public function destroy(Contrainte $contrainte): \Illuminate\Http\JsonResponse
    {
        //Supprimer la contrainte dont l'ID envoyé en paramètre correspond
        Contrainte::destroy($contrainte->id);
        //Redirection
        return $this->sendResponse(ContrainteResource::collection(Contrainte::all()->sortBy('type_contrainte_id')));
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
            'description'=>'max:250',
            'type'=>'required|string|exists:type_contraintes,nom',
            'type_description'=>'required_if:type_contrainte_id,8|max:50',
            'stricte'=>'required|boolean',
            'session'=>'required_if:type_contrainte_id,3|integer|min:0|max:6',
            'enseignants'=>'required_if:type_contrainte_id,1,2,5,7',
            'cours'=>'required_if:type_contrainte_id,6'
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
                $contrainte->users()->detach();
            }
            foreach ($lsEnseignantsId as $id) {
                //Lier l'enseignant à la contrainte
                $contrainte->users()->attach($id);
            }

        }
        //Vérifier que la liste des cours existe
        if($lsCoursId) {
            if($isModifier) {
                //Détacher tous les cours de la contrainte
                $contrainte->cours()->detach();
            }
            foreach ($lsCoursId as $id) {
                //Ignorer les cours supplémentaires
                if(array_search($id, $lsCoursId) < 2) {
                    //Lier le cours à la contrainte
                    $contrainte->cours()->attach($id);
                }
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
                //Ignorer les blocs supplémentaires
                if(array_search($bloc, $lsBlocsHeures) < 5 && $bloc['jour'] !== 'Quotidien' ||
                    array_search($bloc, $lsBlocsHeures) < 3 && $bloc['jour'] === 'Quotidien') {
                    //Récupérer le jour
                    $jour = Jour::all()->firstWhere('nom', $bloc['jour']);
                    //Créer le bloc d'heure
                    BlocHeure::create([
                        'jour_id' => $jour['id'],
                        'heures' => $bloc['heures'],
                        'contrainte_id' => $contrainte['id']
                    ]);
                }
            }
        }
        //Vérifier que la liste des blocs libres existe
        if($lsBlocsLibres) {
            foreach ($lsBlocsLibres as $bloc) {
                //Ignorer les blocs supplémentaires
                if(array_search($bloc, $lsBlocsLibres) < 3) {
                    //Créer le bloc libre
                    BlocLibre::create([
                        'nb_bloc' => $bloc['nb_bloc'],
                        'nb_heure' => $bloc['nb_heure'],
                        'contrainte_id' => $contrainte['id']
                    ]);
                    //Si la contrainte est un de type Généraux, Créer les bloc généraux
                    if ($contrainte['type'] == 'generaux') {

                        //Récupérer le id du bloc libre créer
                        $idBlocLibre = BlocLibre::all()->last()->id;

                        //Crée tous les bloc généraux pour le nombre de bloc désiré
                        for ($index = 1; $index <= $bloc['nb_bloc']; $index++) {
                            BlocGeneraux::create([
                                'jour_id' => 9,
                                'heures' => '0000000000',
                                'dure' => $bloc['nb_heure'],
                                'bloc_libre_id' => $idBlocLibre
                            ]);
                        }
                    }
                }
            }
        }
    }
}
