<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property string $rut
 * @property string|null $usu_nombre
 * @property string|null $apellidoPaterno
 * @property string|null $apellidoMaterno
 * @property string|null $direccion
 * @property string|null $correo
 * @property int|null $telefono
 * @property string|null $usuario
 * @property int|null $pin
 * @property string|null $contrasena
 * @property int|null $tipoUsuario
 * @property int|null $qrUser
 * @property bool|null $usu_status
 * @property string|null $prevision
 * @property string|null $plan_salud
 * @property bool|null $ahorro_voluntario
 * 
 * @property Collection|Contrato[] $contratos
 * @property Collection|Horario[] $horarios
 * @property LiquidacionBono $liquidacion_bono
 * @property Collection|Permiso[] $permisos
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'rut';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'telefono' => 'int',
		'pin' => 'int',
		'tipoUsuario' => 'int',
		'qrUser' => 'int',
		'usu_status' => 'bool',
		'ahorro_voluntario' => 'bool'
	];

	protected $fillable = [
		'usu_nombre',
		'apellidoPaterno',
		'apellidoMaterno',
		'direccion',
		'correo',
		'telefono',
		'usuario',
		'pin',
		'contrasena',
		'tipoUsuario',
		'qrUser',
		'usu_status',
		'prevision',
		'plan_salud',
		'ahorro_voluntario'
	];

	public function contratos()
	{
		return $this->hasMany(Contrato::class, 'rut');
	}

	public function horarios()
	{
		return $this->hasMany(Horario::class, 'rut');
	}

	public function liquidacion_bono()
	{
		return $this->hasOne(LiquidacionBono::class, 'rut');
	}

	public function permisos()
	{
		return $this->hasMany(Permiso::class, 'rut');
	}
}
