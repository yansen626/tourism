<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 08:45:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Package
 * 
 * @property string $id
 * @property string $travelmate_id
 * @property int $category_id
 * @property string $name
 * @property float $price
 * @property int $discount
 * @property float $discount_flat
 * @property float $price_discounted
 * @property string $description
 * @property string $featured_image
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $updated_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Category $category
 * @property \App\Models\Status $status
 * @property \App\Models\Travelmate $travelmate
 * @property \Illuminate\Database\Eloquent\Collection $banners
 * @property \Illuminate\Database\Eloquent\Collection $carts
 * @property \Illuminate\Database\Eloquent\Collection $package_images
 * @property \Illuminate\Database\Eloquent\Collection $transaction_details
 *
 * @package App\Models
 */
class Package extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'category_id' => 'int',
		'price' => 'float',
		'discount' => 'int',
		'discount_flat' => 'float',
		'price_discounted' => 'float',
		'status_id' => 'int'
	];

	protected $fillable = [
		'travelmate_id',
		'category_id',
		'name',
		'price',
		'discount',
		'discount_flat',
		'price_discounted',
		'description',
		'featured_image',
		'status_id',
		'created_by',
		'updated_by'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}

	public function travelmate()
	{
		return $this->belongsTo(\App\Models\Travelmate::class);
	}

	public function banners()
	{
		return $this->hasMany(\App\Models\Banner::class, 'product_id');
	}

	public function carts()
	{
		return $this->hasMany(\App\Models\Cart::class, 'product_id');
	}

	public function package_images()
	{
		return $this->hasMany(\App\Models\PackageImage::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(\App\Models\TransactionDetail::class);
	}


    public function getPriceAttribute(){
        return number_format($this->attributes['price'], 0, ",", ".");
    }

    public function getDiscountFlatAttribute(){
        if(!empty($this->attributes['discount_flat'])){
            return number_format($this->attributes['discount_flat'], 0, ",", ".");
        }
    }

    public function getPriceDiscountedAttribute(){
        if(!empty($this->attributes['price_discounted'])){
            return number_format($this->attributes['price_discounted'], 0, ",", ".");
        }
    }
}
