<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tach
 *
 * @property int $id
 * @property string $titre
 * @property string|null $description
 * @property Carbon $date_echeance
 * @property string|null $priorite
 * @property string|null $etat
 * @property int|null $id_projet
 * @property int|null $id_assigné
 * @property Carbon $date_creation
 *
 * @property Projet|null $projet
 * @property User|null $user
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|PiecesJointe[] $pieces_jointes
 *
 * @package App\Models
 */
class Tache extends Model
{
    protected $table = 'taches';
    public $timestamps = false;

    protected $casts = [
        'date_echeance' => 'datetime',
        'id_projet' => 'int',
        'id_assigne' => 'int',
        'date_creation' => 'datetime'
    ];

    protected $fillable = [
        'titre',
        'description',
        'date_echeance',
        'priorite',
        'etat',
        'id_projet',
        'id_assigne',
        'date_creation'
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_assigne');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_tache');
    }

    public function pieces_jointes()
    {
        return $this->hasMany(PiecesJointe::class, 'id_tache');
    }
}
