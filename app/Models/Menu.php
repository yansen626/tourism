<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 May 2018 04:49:26 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Menu
 * 
 * @property int $id
 * @property int $menu_header_id
 * @property string $name
 * @property string $route
 * 
 * @property \App\Models\MenuHeader $menu_header
 * @property \Illuminate\Database\Eloquent\Collection $menu_subs
 *
 * @package App\Models
 */
class Menu extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'menu_header_id' => 'int'
	];

	protected $fillable = [
		'menu_header_id',
		'name',
		'route'
	];

	public function menu_header()
	{
		return $this->belongsTo(\App\Models\MenuHeader::class);
	}

	public function menu_subs()
	{
		return $this->hasMany(\App\Models\MenuSub::class);
	}
}
