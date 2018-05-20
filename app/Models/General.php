<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 May 2018 15:31:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class General
 * 
 * @property int $id
 * @property float $idrusd
 * @property float $idrrmb
 *
 * @package App\Models
 */
class General extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'idrusd' => 'float',
		'idrrmb' => 'float'
	];

	protected $fillable = [
		'idrusd',
		'idrrmb'
	];
}
