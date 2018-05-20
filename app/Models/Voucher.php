<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 May 2018 10:13:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Voucher
 * 
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property int $amount_percentage
 * @property int $stock
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $finish_date
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * 
 * @property \App\Models\UserAdmin $user_admin
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Voucher extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'amount' => 'float',
		'amount_percentage' => 'int',
		'stock' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'start_date',
		'finish_date'
	];

	protected $fillable = [
		'name',
		'amount',
		'amount_percentage',
		'stock',
		'start_date',
		'finish_date',
		'status_id',
		'created_by'
	];

	public function user_admin()
	{
		return $this->belongsTo(\App\Models\UserAdmin::class, 'created_by');
	}

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}
}
