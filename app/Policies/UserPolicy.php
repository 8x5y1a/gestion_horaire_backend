<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        //
        $lsRoles =$user->role;
        return $this->validerRole($lsRoles,["Administrateur","Coordonnateur"]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $lsRoles =$user->role;
        return $this->validerRole($lsRoles,["Administrateur","Coordonnateur"]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
        $lsRoles =$user->role;
        return $this->validerRole($lsRoles,["Administrateur","Coordonnateur"]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        //
        $lsRoles =$user->role;
        return $this->validerRole($lsRoles,["Administrateur","Coordonnateur"]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
    /**
     * Méthode qui retourne un boolean selon le ou les rôles que l'usager possède.
     * @param array $lsRoles
     * @param string $roleRequis
     * @return bool|void
     */
    private function validerRole($lsRoles,array $lsroleRequis){
        foreach ($lsRoles as $role){
            foreach ($lsroleRequis as $roleRequis){
                if($role->getAttribute('nom') === $roleRequis){
                    return true;
                }
            }
        }
        return false;
    }
}
