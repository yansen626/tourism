<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Jul 2018 15:24:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class General
 * 
 * @property int $id
 * @property float $idrusd
 * @property float $idrrmb
 * @property int $service_fee
 *
 * @package App\Models
 */
class General extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'idrusd' => 'float',
		'idrrmb' => 'float',
		'service_fee' => 'int'
	];

	protected $fillable = [
		'idrusd',
		'idrrmb',
		'service_fee'
	];
}
