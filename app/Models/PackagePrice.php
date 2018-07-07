<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Jul 2018 03:08:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackagePrice
 * 
 * @property int $id
 * @property string $package_id
 * @property int $quantity
 * @property float $price
 * @property int $service_fee
 * @property float $final_price
 * 
 * @property \App\Models\Package $package
 *
 * @package App\Models
 */
class PackagePrice extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'service_fee' => 'int',
		'final_price' => 'float'
	];

	protected $appends = [
	    'price_string',
        'total_price',
        'total_price_string'
    ];

	protected $fillable = [
		'package_id',
		'quantity',
		'price',
		'service_fee',
		'final_price'
	];

    public function getPriceStringAttribute(){
        return number_format($this->attributes['price'], 0, ",", ".");
    }

    public function getTotalPriceAttribute(){
        $price = $this->attributes['price'];
        $qty = $this->attributes['quantity'];
        $totalPrice = $price * $qty;
        return $totalPrice;
    }

    public function getTotalPriceStringAttribute(){
        $price = $this->attributes['price'];
        $qty = $this->attributes['quantity'];
        $totalPrice = $price * $qty;
        return number_format($totalPrice, 0, ",", ".");
    }

    public function getFinalPriceAttribute(){
        return number_format($this->attributes['final_price'], 0, ",", ".");
    }

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}
}
