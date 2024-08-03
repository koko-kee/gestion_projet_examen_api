<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Projet
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property Carbon $date_debut
 * @property Carbon|null $date_fin
 * @property string|null $etat
 * @property int|null $id_responsable
 * 
 * @property User|null $user
 * @property Invitation $invitation
 * @property Collection|Tach[] $taches
 *
 * @package App\Models
 */
class Projet extends Model
{
	protected $table = 'projets';
	public $timestamps = false;

	protected $casts = [
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'id_responsable' => 'int'
	];

	protected $fillable = [
		'nom',
		'description',
		'date_debut',
		'date_fin',
		'etat',
		'id_responsable'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_responsable');
	}

	public function invitation()
	{
		return $this->hasOne(Invitation::class, 'id_projet');
	}

	public function taches()
	{
		return $this->hasMany(Tach::class, 'id_projet');
	}
}
