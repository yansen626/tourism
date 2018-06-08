<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Jun 2018 07:28:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackageImage
 * 
 * @property int $id
 * @property string $package_id
 * @property string $path
 * @property int $featured
 * 
 * @property \App\Models\Package $package
 *
 * @package App\Models
 */
class PackageImage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'featured' => 'int'
	];

	protected $fillable = [
		'package_id',
		'path',
		'featured'
	];

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}
}
