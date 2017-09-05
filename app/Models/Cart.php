<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cart
 * 
 * @property int $id
 * @property string $product_id
 * @property string $user_id
 * @property int $quantity
 * @property float $total_price
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Cart extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'int',
		'total_price' => 'float'
	];

	protected $fillable = [
		'product_id',
		'user_id',
		'quantity',
		'total_price'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

    public function getTotalPriceAttribute(){
        return number_format($this->attributes['total_price'], 0, ",", ".");
    }
}
