<?php
/** @Author: Jean-Francois Gamache (Itération 2) */
namespace App\Http\Controllers;

use App\Http\Resources\HoraireResource;
use App\Models\Horaire;
use Brick\Math\BigInteger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HoraireController extends BaseController
{
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
    public function show(BigInteger $id)
    {
        return $this->sendResponse(HoraireResource::collection(Horaire::all()->where('horaire_id' == $id)));

    }

    /**
     * Fonction qui permet de modifier les horaires
     */
    public function update(Request $request, Horaire $horaire): JsonResponse
    {
        $horaire->update([
            'lundi' => $request->lundi,
            'mardi' => $request->mardi,
            'mercredi' => $request->mercredi,
            'jeudi' => $request->jeudi,
            'vendredi' => $request->vendredi,
        ]);
        $horaire->save();
        return $this->sendResponse(HoraireResource::collection(Horaire::all()));
    }
}
