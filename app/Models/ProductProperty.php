<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 09 Oct 2017 04:40:43 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductProperty
 * 
 * @property int $id
 * @property string $product_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $weight
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductProperty extends Eloquent
{
	public $timestamps = false;

    protected $casts = [
        'weight' => 'int',
        'price' => 'float',
    ];

	protected $fillable = [
		'product_id',
		'name',
		'description',
        'price',
        'weight'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function getPriceAttribute(){
        if(!empty($this->attributes['price'])){
            return number_format($this->attributes['price'], 0, ",", ".");
        }
    }
}
