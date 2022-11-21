<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liquidaciondesueldo
 * 
 * @property int $idLiquidacion
 * @property bool|null $liq_status
 * @property string|null $nom_nombre
 * @property string|null $urlLiquidacion
 * @property Carbon|null $fecha_liquidacion
 * 
 * @property LiquidacionBono $liquidacion_bono
 *
 * @package App\Models
 */
class Liquidaciondesueldo extends Model
{
	protected $table = 'liquidaciondesueldo';
	protected $primaryKey = 'idLiquidacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idLiquidacion' => 'int',
		'liq_status' => 'bool'
	];

	protected $dates = [
		'fecha_liquidacion'
	];

	protected $fillable = [
		'liq_status',
		'idLiquidacion',
		'nom_nombre',
		'urlLiquidacion',
		'fecha_liquidacion'
	];

	public function liquidacion_bono()
	{
		return $this->hasOne(LiquidacionBono::class, 'idLiquidacion');
	}
}
