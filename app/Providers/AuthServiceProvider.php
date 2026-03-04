<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Cours' => 'App\Policies\CoursPolicy',
        'App\Models\Contrainte' => 'App\Policies\ContraintePolicy',
        'App\Models\Cheminement' => 'App\Policies\CheminementPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Local' => 'App\Policies\LocalPolicy',
        'App\Models\Horaire' => 'App\Policies\HorairePolicy',
        'App\Models\Campus' => 'App\Policies\CampusPolicy',
        'App\Models\GroupeCours' => 'App\Policies\GroupeCoursPolicy',
        'App\Models\BlocCours' => 'App\Policies\BlocCoursPolicy',
        'App\Models\BlocLibre' => 'App\Policies\BlocLibrePolicy',
        'App\Models\BlocHeure' => 'App\Policies\BlocHeurePolicy',
        'App\Models\BlocGeneraux' => 'App\Policies\BlocGenerauxPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token, bool $premiereUtilisation) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::define("admin",function (User $user){
           return $this->validation($user,['Administrateur']);
        });
        Gate::define("coordonnateur",function (User $user){
            return $this->validation($user,'Coordonnateur');
        });
        Gate::define("enseignant",function (User $user){
          return $this->validation($user,'Enseignant');
        });
    }
    public function validation($user,$roleRequis){
        $lsRole = $user->role;
        foreach ($lsRole as $role){
            if($role->getAttribute('nom')=== $roleRequis){
                return true;
            }
        }
        return false;
    }
}
