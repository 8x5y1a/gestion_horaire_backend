<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\BlocCours;
use App\Models\GroupeCours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Local;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\password;

/* @author: Fabrice Fortin */
class UserController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('prenom')));
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
    public function store(Request $request): JsonResponse
    {
        $this->validationUser($request);
        $request->validate([
            'email' =>'unique:'.User::class,
        ]);
        $user = User::create([
            'prenom'=>$request->prenom,
            'nom'=>$request->nom,
            'bureau'=>$request->bureau,
            'poste'=> $request->poste,
            'password'=>bcrypt(fake()->password),
            'email'=>$request->email,
            'premiere_utilisation'=>true,
            'horaire_id'=> Horaire::factory()->create()->id
        ]);
        foreach ($request->role as $id){
            $setRole = Role::find($id);
            $user->role()->attach($setRole);
        }
        $user->save();
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('prenom')));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('user.show',[
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('user.edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $this->validationUser($request);
        $user->update([
            'prenom'=>$request->prenom,
            'nom'=>$request->nom,
            'bureau'=>$request->bureau,
            'poste'=> $request->poste,
        ]);
        $user->role()->detach();
        foreach ($request->role as $id){
            $setRole = Role::find($id);
            $user->role()->attach($setRole);
        }
        $user->save();
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('prenom')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        if(User::all()->count() > 1) {
            //Récupérer tous les groupes cours appartenant à l'utilsateur
            $listeGroupeCours = GroupeCours::all()->where('user_id', $user['id']);
            foreach ($listeGroupeCours as $groupe) {
                //Récupérer tous les blocs cours appartenant à l'utilisateur
                $listeBlocCours = BlocCours::all()->where('groupe_cours_id', $groupe['id']);
                foreach ($listeBlocCours as $bloc) {
                    //Récupérer le jour du bloc cours
                    $jour = Jour::find($bloc['jour_id']);
                    //Récupérer l'horaire du local
                    $local = Local::find($bloc['local_id']);
                    if ($local != null) {
                        $horaireLocal = Horaire::find($local['horaire_id']);

                        //Calculer l'horaire du local sans le bloc cours
                        $heureModifiee = '0000000000';
                        for ($i = 0; $i < 10; $i++) {
                            if ($bloc['heures'][$i] != 1 && $horaireLocal[$jour['nom']][$i] == 1) {
                                $heureModifiee[$i] = 1;
                            }
                        }
                        //Mettre à jour l'horaire du local
                        $horaireLocal->update([$jour['nom'] => $heureModifiee]);
                        //Mettre à jour le bloc cours
                        $bloc->update(['heures' => '0000000000', 'local_id' => null]);
                        $horaireLocal->save();
                        $bloc->save();
                    }
                }
            }
            //Vider l'horaire de l'utilisateur
            $user->horaire()->update([
                'Lundi' => '0000000000',
                'Mardi' => '0000000000',
                'Mercredi' => '0000000000',
                'Jeudi' => '0000000000',
                'Vendredi' => '0000000000'
            ]);
            $user->save();
            //Supprimer l'utilisateur
            User::destroy($user->id);
            $user->save();

        }
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('prenom')));
    }
    private function validationUser(Request $request): array
    {
        return $request->validate([
            'prenom'=>'required|String',
            'nom'=>'required|String',
            'bureau'=>'nullable|String|max:30',
            'poste'=>'nullable|String|regex:#^([0-9]*)$#',
            'role'=>'required|array',
            'role.*.id'=>'exists:roles,id',
        ]);
    }

}
