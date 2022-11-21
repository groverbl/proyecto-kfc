<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LiquidacionBono
 * 
 * @property int|null $idBono
 * @property int|null $idLiquidacion
 * @property string|null $rut
 * 
 * @property Bono|null $bono
 * @property Liquidaciondesueldo|null $liquidaciondesueldo
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class LiquidacionBono extends Model
{
	protected $table = 'liquidacion_bono';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idBono' => 'int',
		'idLiquidacion' => 'int'
	];

	protected $fillable = [
		'idBono',
		'idLiquidacion',
		'rut'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class, 'idBono');
	}

	public function liquidaciondesueldo()
	{
		return $this->belongsTo(Liquidaciondesueldo::class, 'idLiquidacion');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'rut');
	}
}
