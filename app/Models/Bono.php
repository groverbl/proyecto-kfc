<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bono
 * 
 * @property int $idLiquidacion
 * @property string $rut
 * @property int $idBono
 * @property bool|null $bonStatus
 * @property string|null $nombreBono
 * @property int|null $monto
 * 
 * @property Liquidaciondesueldo $liquidaciondesueldo
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Bono extends Model
{
	protected $table = 'bonos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idLiquidacion' => 'int',
		'idBono' => 'int',
		'bonStatus' => 'bool',
		'monto' => 'int'
	];

	protected $fillable = [
		'idBono',
		'bonStatus',
		'nombreBono',
		'monto'
	];

	public function liquidaciondesueldo()
	{
		return $this->belongsTo(Liquidaciondesueldo::class, 'idLiquidacion');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'rut');
	}
}
