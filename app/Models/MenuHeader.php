<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 May 2018 04:50:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MenuHeader
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $menus
 *
 * @package App\Models
 */
class MenuHeader extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function menus()
	{
		return $this->hasMany(\App\Models\Menu::class);
	}
}
