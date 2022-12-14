<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 * 
 * @property int $idContrato
 * @property string $rut
 * @property bool|null $con_status
 * @property string|null $con_nombre
 * @property string|null $urlContrato
 * @property bool|null $tipoContrato
 * @property int|null $sueldoBase
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Contrato extends Model
{
	protected $table = 'contrato';
	protected $primaryKey = 'idContrato';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idContrato' => 'int',
		'con_status' => 'bool',
		'tipoContrato' => 'bool',
		'sueldoBase' => 'int'
	];

	protected $fillable = [
		'rut',
		'con_status',
		'con_nombre',
		'urlContrato',
		'tipoContrato',
		'sueldoBase'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'rut');
	}
}
