<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 May 2018 04:49:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MenuSub
 * 
 * @property int $id
 * @property string $name
 * @property int $menu_id
 * @property string $route
 * 
 * @property \App\Models\Menu $menu
 *
 * @package App\Models
 */
class MenuSub extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'menu_id' => 'int'
	];

	protected $fillable = [
		'name',
		'menu_id',
		'route'
	];

	public function menu()
	{
		return $this->belongsTo(\App\Models\Menu::class);
	}
}
