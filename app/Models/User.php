<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $mot_de_passe
 * @property int $role
 * @property Carbon $create_date
 *
 * @property Collection|Commentaire[] $commentaires
 * @property Invitation $invitation
 * @property Collection|Notification[] $notifications
 * @property Collection|Projet[] $projets
 * @property Collection|Tach[] $taches
 *
 * @package App\Models
 */
class User extends Model
{
    use Notifiable;
    protected $table = 'users';
    public $timestamps = false;

    protected $casts = [
        'role' => 'int',
        'create_date' => 'datetime'
    ];

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
        'create_date'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur');
    }

    public function invitation()
    {
        return $this->hasOne(Invitation::class, 'id_utilisateur');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_utilisateur');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'id_responsable');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_assigné');
    }
}
