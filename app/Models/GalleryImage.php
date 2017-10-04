<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Oct 2017 08:02:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GalleryImage
 * 
 * @property int $id
 * @property int $gallery_id
 * @property string $file_name
 * @property int $position
 * 
 * @property \App\Models\Gallery $gallery
 *
 * @package App\Models
 */
class GalleryImage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'gallery_id' => 'int',
		'position' => 'int'
	];

	protected $fillable = [
		'gallery_id',
		'file_name',
		'position'
	];

	public function gallery()
	{
		return $this->belongsTo(\App\Models\Gallery::class);
	}
}
