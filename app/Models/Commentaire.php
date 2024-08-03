<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commentaire
 * 
 * @property int $id
 * @property string $texte
 * @property Carbon $date
 * @property int|null $id_tache
 * @property int|null $id_utilisateur
 * 
 * @property Tach|null $tach
 * @property User|null $user
 *
 * @package App\Models
 */
class Commentaire extends Model
{
	protected $table = 'commentaires';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'id_tache' => 'int',
		'id_utilisateur' => 'int'
	];

	protected $fillable = [
		'texte',
		'date',
		'id_tache',
		'id_utilisateur'
	];

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_utilisateur');
	}
}
