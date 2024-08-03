<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PiecesJointe
 * 
 * @property int $id
 * @property string $nom_fichier
 * @property string $chemin_fichier
 * @property int|null $id_tache
 * @property Carbon $date_ajout
 * 
 * @property Tach|null $tach
 *
 * @package App\Models
 */
class PiecesJointe extends Model
{
	protected $table = 'pieces_jointes';
	public $timestamps = false;

	protected $casts = [
		'id_tache' => 'int',
		'date_ajout' => 'datetime'
	];

	protected $fillable = [
		'nom_fichier',
		'chemin_fichier',
		'id_tache',
		'date_ajout'
	];

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}
}
