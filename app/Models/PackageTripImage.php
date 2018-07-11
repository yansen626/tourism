<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Jul 2018 03:09:04 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackageTripImage
 * 
 * @property int $id
 * @property int $trip_id
 * @property string $filename
 * 
 * @property \App\Models\PackageTrip $package_trip
 *
 * @package App\Models
 */
class PackageTripImage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'trip_id' => 'int'
	];

	protected $fillable = [
		'trip_id',
		'filename'
	];

	public function package_trip()
	{
		return $this->belongsTo(\App\Models\PackageTrip::class, 'trip_id');
	}
}
