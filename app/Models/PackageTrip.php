<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Jul 2018 03:07:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackageTrip
 * 
 * @property int $id
 * @property string $package_id
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property string $description
 * @property string $featured_image
 * 
 * @property \App\Models\Package $package
 *
 * @package App\Models
 */
class PackageTrip extends Eloquent
{

	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'package_id',
		'start_date',
		'end_date',
		'description',
		'featured_image'
	];

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}
}
