<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 * 
 * @property int $idPermiso
 * @property string|null $rut
 * @property Carbon|null $fechaInicio
 * @property Carbon|null $fechaTermino
 * @property string|null $motivo
 * @property int|null $urlJustificativo
 * @property bool|null $estado
 * @property bool|null $per_status
 * @property string|null $respuesta
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permiso';
	protected $primaryKey = 'idPermiso';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idPermiso' => 'int',
		'urlJustificativo' => 'int',
		'estado' => 'bool',
		'per_status' => 'bool'
	];

	protected $dates = [
		'fechaInicio',
		'fechaTermino'
	];

	protected $fillable = [
		'rut',
		'fechaInicio',
		'fechaTermino',
		'motivo',
		'urlJustificativo',
		'estado',
		'per_status',
		'respuesta'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'rut');
	}
}
