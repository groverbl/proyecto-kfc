<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Horario
 * 
 * @property int $idHorario
 * @property string $rut
 * @property Carbon|null $fecha
 * @property Carbon|null $horaInicio
 * @property int|null $horaTermino
 * @property bool|null $hor_status
 * @property bool|null $isFeriado
 * @property bool|null $asistencia
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Horario extends Model
{
	protected $table = 'horario';
	protected $primaryKey = 'idHorario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idHorario' => 'int',
		'horaTermino' => 'int',
		'hor_status' => 'bool',
		'isFeriado' => 'bool',
		'asistencia' => 'bool'
	];

	protected $dates = [
		'fecha',
		'horaInicio'
	];

	protected $fillable = [
		'rut',
		'fecha',
		'horaInicio',
		'horaTermino',
		'hor_status',
		'isFeriado',
		'asistencia'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'rut');
	}
}
