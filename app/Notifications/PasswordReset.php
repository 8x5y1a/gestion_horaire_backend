<?php
//SOURCE:
// https://stackoverflow.com/questions/41400395/replace-password-reset-mail-template-with-custom-template-laravel-5-3
// https://laravel.com/docs/10.x/notifications#customizing-the-templates
namespace App\Notifications;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    private string $token;
    private User $user;
    private bool $premiereUtilisation;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $user, $premiereUtilisation)
    {
        //Vérifier que le jeton correspond à une série de charactères alphanumériques
        preg_match('/^[A-Za-z0-9]+$/u', $token) ? $this->token = $token : $this->token = '';
        $this->user = $user;
        $this->premiereUtilisation = $premiereUtilisation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * @author Louis Peterlini - Itération 3
     * Méthode qui envoie la notification sous forme de courriel.
     */
    public function toMail(object $notifiable): MailMessage
    {
        //Créer le message à envoyer
        $message = (new MailMessage)
            ->from('gestion_horaire@cegepoutaouais.qc.ca', 'Gestion d\'horaires du CÉGEP de l\'Outaouais');

        //Vérifier si on envoie un message pour la première utilisation ou pour l'oubli de mot de passe
        if($this->premiereUtilisation){ //Première utilisation
            $message
                ->subject('Créer votre mot de passe')
                ->line('Vous recevez ce courriel parce que nous avons reçu une demande de création de mot de passe pour votre compte.')
                ->line('Pour créer votre mot de passe, cliquez sur le bouton suivant:')
                ->action('Créer mon mot de passe', url('http://localhost:8100/modifier-mot-de-passe/?token=' . $this->token . '&email=' . $this->user->email));
        }
        else{ //Oubli de mot de passe
            $message
                ->subject('Réinitialiser votre mot de passe')
                ->line('Vous recevez ce courriel parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
                ->line('Pour réinitialiser votre mot de passe, cliquez sur le bouton suivant:')
                ->action('Réinitialiser mon mot de passe', url('http://localhost:8100/modifier-mot-de-passe/?token=' . $this->token . '&email=' . $this->user->email));

        }

        //Lignes à ajouter à la fin du message
        $message
            ->line('Ce lien expirera dans 60 minutes.')
            ->line('Si vous n\'êtes pas à l\'origine de cette demande. Vous pouvez ignorer ce message.');

        //Envoyer le message par courriel
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
