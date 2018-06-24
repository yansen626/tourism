<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 09:39:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Travelmate
 * 
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $total_point
 * @property int $rating
 * @property int $city_id
 * @property int $province_id
 * @property string $description
 * @property string $profile_picture
 * @property string $banner_picture
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $updated_at
 * @property string $updated_by
 * 
 * @property \App\Models\City $city
 * @property \App\Models\Province $province
 * @property \App\Models\Status $status
 * @property \Illuminate\Database\Eloquent\Collection $packages
 *
 * @package App\Models
 */
class Travelmate extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rating' => 'int',
		'city_id' => 'int',
		'province_id' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'total_point'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'total_point',
		'rating',
		'city_id',
		'province_id',
		'description',
		'profile_picture',
		'banner_picture',
		'status_id',
		'created_by',
		'updated_by'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function province()
	{
		return $this->belongsTo(\App\Models\Province::class);
	}

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}

	public function packages()
	{
		return $this->hasMany(\App\Models\Package::class);
	}
}
