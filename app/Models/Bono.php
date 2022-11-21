<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bono
 * 
 * @property int $idBono
 * @property bool|null $bonStatus
 * @property string|null $nombreBono
 * @property int|null $monto
 * 
 * @property LiquidacionBono $liquidacion_bono
 *
 * @package App\Models
 */
class Bono extends Model
{
	protected $table = 'bonos';
	protected $primaryKey = 'idBono';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idBono' => 'int',
		'bonStatus' => 'bool',
		'monto' => 'int'
	];

	protected $fillable = [
		'bonStatus',
		'nombreBono',
		'monto'
	];

	public function liquidacion_bono()
	{
		return $this->hasOne(LiquidacionBono::class, 'idBono');
	}
}
