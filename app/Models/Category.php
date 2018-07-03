<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Jul 2018 04:19:40 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
