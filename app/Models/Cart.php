<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Jul 2018 04:56:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cart
 * 
 * @property int $id
 * @property string $package_id
 * @property string $user_id
 * @property string $voucher_code
 * @property float $voucher_amount
 * @property float $admin_fee
 * @property string $payment_method
 * @property int $qty
 * @property float $price
 * @property float $total_price
 *
 * @property \App\Models\Package $package
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Cart extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'admin_fee' => 'float'
	];

	protected $fillable = [
		'package_id',
		'user_id',
		'admin_fee',
		'voucher_code',
		'voucher_amount',
		'payment_method',
		'price',
		'total_price',
		'qty'
	];

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
