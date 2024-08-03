<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invitation
 * 
 * @property int $id
 * @property int $id_projet
 * @property int $id_utilisateur
 * @property string $status
 * @property Carbon $date_creation
 * 
 * @property Projet $projet
 * @property User $user
 *
 * @package App\Models
 */
class Invitation extends Model
{
	protected $table = 'invitations';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_projet' => 'int',
		'id_utilisateur' => 'int',
		'date_creation' => 'datetime'
	];

	protected $fillable = [
		'id',
		'id_projet',
		'id_utilisateur',
		'status',
		'date_creation'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_utilisateur');
	}
}
