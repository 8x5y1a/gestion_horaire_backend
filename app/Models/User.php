<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'bureau',
        'poste',
        'premiere_utilisation',
        'horaire_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function horaire() : BelongsTo{
        return $this->belongsTo(Horaire::class, 'horaire_id');
    }
    public function role() : BelongsToMany{
        return $this->belongsToMany(Role::class);
    }
    public function abandon_horaire(): void{
        $this->horaire()->disassociate();
        $this->save();
    }
    public function contrainte(): BelongsToMany{
        return $this->belongsToMany(Contrainte::class);
    }

    /**
     * @author Louis Peterlini - Itération 3
     * Méthode qui renvoie une notification personnalisée par courriel.
     * @param $token string Le jeton associé à l'utilisateur.
     * @return void
     */
    public function sendPasswordResetNotification($token) : void
    {
        $this->notify(new PasswordReset($token, $this, $this->premiere_utilisation));
        $this->update([
            'premiere_utilisation'=>false,
        ]);
        $this->save();
    }
}
