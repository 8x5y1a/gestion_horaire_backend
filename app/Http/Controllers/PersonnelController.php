<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonnelResource;
use App\Http\Resources\UserResource;
use App\Models\Horaire;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
/* @author: Fabrice Fortin */
class PersonnelController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(PersonnelResource::collection(Personnel::all()->sortBy('prenom')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validationPersonnel($request);
        $user = User::factory()->create([
            'name'=>$request->prenom . ' ' . $request->nom,
            'email'=>$request->adresse_courriel,
            'password' => 'defaut'
        ]);
        Personnel::create([
            'prenom'=>$request->prenom,
            'nom'=>$request->nom,
            'bureau'=>$request->bureau,
            'poste'=> $request->poste,
            'role'=> $request->role,
            'adresse_courriel'=>$request->adresse_courriel,
            'user_id' => $user->id,
            'horaire_id'=> Horaire::factory()->create()->id
        ]);
        return $this->sendResponse(PersonnelResource::collection(Personnel::all()->sortBy('prenom')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Personnel $personnel)
    {
        return view('personnel.show',[
            'personnel' => $personnel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personnel $personnel)
    {
        return view('personnel.edit',[
            'personnel' => $personnel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personnel $personnel)
    {
        $this->validationPersonnelModifier($request);
        $user = User::where('id',$personnel->user_id)->first();
        $user->update([
            'name'=>$request->prenom . ' ' . $request->nom
        ]);
        $personnel->update([
            'prenom'=>$request->prenom,
            'nom'=>$request->nom,
            'bureau'=>$request->bureau,
            'poste'=> $request->poste,
            'role'=> $request->role
        ]);
        $personnel->save();
        $user->save();
        return $this->sendResponse(PersonnelResource::collection(Personnel::all()->sortBy('prenom')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        $personnel = Personnel::find($personnel);
        Personnel::destroy($personnel);
        return $this->sendResponse(PersonnelResource::collection(Personnel::all()->sortBy('prenom')));
    }
    private function validationPersonnel(Request $request)
    {
        return $request->validate([
            'prenom'=>'required|String',
            'nom'=>'required|String',
            'bureau'=>'nullable|String|regex:#^[1-2]\.[0-9]{3}([A-B])?$#',
            'adresse_courriel' =>'unique:'.Personnel::class,
            'poste'=>'nullable|String|regex:#^([0-9]*)$#',
            'role'=>'required|String',
        ]);
    }
    private function validationPersonnelModifier(Request $request)
    {
        return $request->validate([
            'prenom'=>'required|String',
            'nom'=>'required|String',
            'bureau'=>'nullable|String|regex:#^[1-2]\.[0-9]{3}([A-B])?$#',
            'poste'=>'nullable|String|regex:#^([0-9]*)$#',
            'role'=>'required|String',
        ]);
    }
}
