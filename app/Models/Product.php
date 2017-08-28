<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property string $id
 * @property string $name
 * @property float $price
 * @property int $discount
 * @property float $discount_flat
 * @property float $price_discounted
 * @property int $quantity
 * @property int $weight
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_on
 * @property string $modified_by
 * @property \Carbon\Carbon $modified_on
 * 
 * @property \App\Models\Status $status
 * @property \Illuminate\Database\Eloquent\Collection $carts
 * @property \Illuminate\Database\Eloquent\Collection $transaction_details
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'discount' => 'int',
		'discount_flat' => 'float',
		'price_discounted' => 'float',
		'quantity' => 'int',
		'weight' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'created_on',
		'modified_on'
	];

	protected $fillable = [
		'name',
		'price',
		'discount',
		'discount_flat',
		'price_discounted',
		'quantity',
		'weight',
		'status_id',
		'created_by',
		'created_on',
		'modified_by',
		'modified_on'
	];

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}

	public function carts()
	{
		return $this->hasMany(\App\Models\Cart::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(\App\Models\TransactionDetail::class);
	}
}
