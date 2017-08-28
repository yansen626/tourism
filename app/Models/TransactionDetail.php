<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TransactionDetail
 * 
 * @property string $id
 * @property string $transaction_id
 * @property string $product_id
 * @property string $name
 * @property float $price_basic
 * @property float $price_final
 * @property float $subtotal_price
 * @property int $quantity
 * @property int $discount
 * @property float $discount_flat
 * @property int $weight
 * @property string $created_by
 * @property \Carbon\Carbon $created_on
 * @property string $modified_by
 * @property \Carbon\Carbon $modified_on
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\Transaction $transaction
 *
 * @package App\Models
 */
class TransactionDetail extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'price_basic' => 'float',
		'price_final' => 'float',
		'subtotal_price' => 'float',
		'quantity' => 'int',
		'discount' => 'int',
		'discount_flat' => 'float',
		'weight' => 'int'
	];

	protected $dates = [
		'created_on',
		'modified_on'
	];

	protected $fillable = [
		'transaction_id',
		'product_id',
		'name',
		'price_basic',
		'price_final',
		'subtotal_price',
		'quantity',
		'discount',
		'discount_flat',
		'weight',
		'created_by',
		'created_on',
		'modified_by',
		'modified_on'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function transaction()
	{
		return $this->belongsTo(\App\Models\Transaction::class);
	}
}
