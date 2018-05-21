<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 May 2018 02:32:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Travelmate
 * 
 * @property string $id
 * @property string $name
 * @property int $city_id
 * @property \Carbon\Carbon $created_at
 * @property string $created_by
 * @property \Carbon\Carbon $updated_at
 * @property string $updated_by
 * 
 * @property \App\Models\City $city
 * @property \Illuminate\Database\Eloquent\Collection $packets
 *
 * @package App\Models
 */
class Travelmate extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'city_id' => 'int'
	];

	protected $fillable = [
		'name',
		'city_id',
		'created_by',
		'updated_by'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function packets()
	{
		return $this->hasMany(\App\Models\Packet::class);
	}
}
