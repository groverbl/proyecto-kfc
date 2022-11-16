<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liquidaciondesueldo
 * 
 * @property int $idLiquidacion
 * @property bool|null $liq_status
 * @property string|null $liq_nombre
 * @property string|null $urlLiquidacion
 * 
 * @property Collection|Bono[] $bonos
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

	protected $fillable = [
		'liq_status',
		'liq_nombre',
		'urlLiquidacion'
	];

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'idLiquidacion');
	}
}
