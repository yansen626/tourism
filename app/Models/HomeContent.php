<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 28 Jun 2018 04:33:38 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class HomeContent
 * 
 * @property int $id
 * @property string $section
 * @property string $image_path
 * @property string $content_1
 * @property string $content_2
 * @property string $content_3
 * @property string $content_4
 * @property string $content_5
 * @property string $link
 *
 * @package App\Models
 */
class HomeContent extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'section',
		'image_path',
		'content_1',
		'content_2',
		'content_3',
		'content_4',
		'content_5',
		'link'
	];
}
