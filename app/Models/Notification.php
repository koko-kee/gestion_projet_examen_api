<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $id
 * @property string $message
 * @property Carbon $date
 * @property int|null $id_utilisateur
 * @property string $type
 * @property int|null $id_element
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notifications';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'id_utilisateur' => 'int',
		'id_element' => 'int'
	];

	protected $fillable = [
		'message',
		'date',
		'id_utilisateur',
		'type',
		'id_element'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_utilisateur');
	}
}
