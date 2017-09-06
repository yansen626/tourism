<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 06 Sep 2017 08:09:30 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StoreDatum
 * 
 * @property string $address
 * @property int $province_id
 * @property int $city_id
 *
 * @package App\Models
 */
class StoreDatum extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'province_id' => 'int',
		'city_id' => 'int'
	];

	protected $fillable = [
		'address',
		'province_id',
		'city_id'
	];
}
