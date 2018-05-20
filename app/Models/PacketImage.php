<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 May 2018 10:12:11 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PacketImage
 * 
 * @property int $id
 * @property string $packet_id
 * @property string $path
 * @property int $featured
 * 
 * @property \App\Models\Packet $packet
 *
 * @package App\Models
 */
class PacketImage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'featured' => 'int'
	];

	protected $fillable = [
		'packet_id',
		'path',
		'featured'
	];

	public function packet()
	{
		return $this->belongsTo(\App\Models\Packet::class);
	}
}
