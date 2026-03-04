<?php
/** @Author: Jean-Francois Gamache (Itération 2) */
namespace App\Http\Controllers;

use App\Http\Resources\HoraireResource;
use App\Models\BlocCours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Local;
use Brick\Math\BigInteger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HoraireController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Horaire::class);
    }
    /**
     * Fonction qui permet de récupérer les horaires
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(HoraireResource::collection(Horaire::all()));
    }

    /**
     * Fonction qui trouve l'horaire selon le ID
     */
    public function show(BigInteger $id): JsonResponse
    {
        return $this->sendResponse(HoraireResource::collection(Horaire::all()->where('horaire_id' == $id)));
    }

    /**
     * @Author Jean-François Gamache | Itération 3.
     * Fonction qui permet de modifier tous les horaires et tous les blocs cours.
     * Cette méthode est utilisé pour faire 1 seule requête au serveur. Elle contient plusieurs horaires à modifier et
     * plusieurs blocs cours.
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void {
        //Modifié tous les horaires
        foreach ($request->input('horaire') as $objHoraire){

            //Valider les horaires
            $this->validate_horaire($objHoraire);

            //Modifier les horaires
            $horaire = Horaire::find($objHoraire['id']);
            $horaire->update([
                'Lundi' => $objHoraire['Lundi'],
                'Mardi' => $objHoraire['Mardi'],
                'Mercredi' => $objHoraire['Mercredi'],
                'Jeudi' => $objHoraire['Jeudi'],
                'Vendredi' => $objHoraire['Vendredi'],
            ]);
            $horaire->save();
        }

        //Modifié tous les blocs cours
        foreach ($request->input('blocCours') as $objBlocCours){

            //Valider les blocs cours.
            $this->validate_blocCours($objBlocCours);

            $blocCours = BlocCours::find($objBlocCours['id']);

            //Récupérer le local et le modifier
            if($objBlocCours['local']){
                $local_id = $objBlocCours['local']['id'];
                $local = Local::find($local_id);

                //Vérifier que le local existe et l'attribuer
                if(isset($local)){
                    $blocCours->setLocal($local);
                }
            }
            //Si on le déplace vers la liste des cours technique
            else{
                $blocCours->local_id = null;
            }

            //Récupérer le jour
            $jour = Jour::all()->firstWhere('nom', $objBlocCours['jour']);

            //Modifier le bloc cours envoyé en paramètre
            $blocCours->update([
                'jour_id' => $jour['id'],
                'heures' => $objBlocCours['heures'],
                'dure'=> $objBlocCours['dure'],
            ]);
            $blocCours->save();
        }
    }
    /**
     * @Author: Jean-François Gamache | Itération 3
     * Fonction qui permet de valider les données des horaires reçues du client.
     * @param array $horaire
     * @return void
     */
    public function validate_horaire(array $horaire): array
    {
        $validation = [
            'Lundi' => 'required|string|size:10|regex:/^[01]{10}$/',
            'Mardi' => 'required|string|size:10|regex:/^[01]{10}$/',
            'Mercredi' => 'required|string|size:10|regex:/^[01]{10}$/',
            'Jeudi' => 'required|string|size:10|regex:/^[01]{10}$/',
            'Vendredi' => 'required|string|size:10|regex:/^[01]{10}$/',
        ];

        return validator($horaire, $validation)->validate();
    }

    /**
     * @Author: Jean-François Gamache | Itération 3
     * Fonction qui permet de valider les données des blocs cours reçues du client
     * @param array $blocCour
     * @return array
     */
    public function validate_blocCours(array $blocCour): array{

        $validation = [
            'jour' => 'string|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi,Dimanche,Aucun|exists:jours,nom',
            'heures' => 'string|size:10|regex:/^[01]{10}$/',
            'dure' => 'required|int|min:1|max:20',
            'local_id'=>'exists:locaux,id',
            'groupe_cours_id'=>'exists:groupe_cours,id',
        ];

        return validator($blocCour, $validation)->validate();
    }
}
