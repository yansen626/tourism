<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Oct 2017 01:46:50 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Gallery
 * 
 * @property int $id
 * @property string $name
 * @property int $status_id
 * @property \Carbon\Carbon $created_at
 * @property string $created_by
 * @property \Carbon\Carbon $updated_at
 * @property string $updated_by
 * 
 * @property \App\Models\UserAdmin $user_admin
 * @property \Illuminate\Database\Eloquent\Collection $gallery_images
 *
 * @package App\Models
 */
class Gallery extends Eloquent
{
    protected $casts = [
        'status_id' => 'int'
    ];

	protected $fillable = [
		'name',
        'status_id',
		'created_by',
		'updated_by'
	];

	public function user_admin()
	{
		return $this->belongsTo(\App\Models\UserAdmin::class, 'updated_by');
	}

	public function gallery_images()
	{
		return $this->hasMany(\App\Models\GalleryImage::class);
	}

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }
}
