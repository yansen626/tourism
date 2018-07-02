<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 29 Jun 2018 04:20:12 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Package
 * 
 * @property string $id
 * @property string $travelmate_id
 * @property string $name
 * @property int $province_id
 * @property int $city_id
 * @property string $location_detail
 * @property float $price
 * @property int $discount
 * @property float $discount_flat
 * @property float $final_price
 * @property string $description
 * @property string $featured_image
 * @property string $duration
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $updated_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\City $city
 * @property \App\Models\Province $province
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
		'province_id' => 'int',
		'city_id' => 'int',
		'price' => 'float',
		'discount' => 'int',
		'discount_flat' => 'float',
		'final_price' => 'float',
		'status_id' => 'int'
	];

	protected $dates = [
	    'start_date',
        'end_date'
    ];

	protected $fillable = [
		'travelmate_id',
		'name',
		'province_id',
		'city_id',
		'location_detail',
		'price',
		'discount',
		'discount_flat',
		'final_price',
		'description',
		'featured_image',
		'duration',
        'start_date',
        'end_date',
		'status_id',
		'created_by',
		'updated_by'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function province()
	{
		return $this->belongsTo(\App\Models\Province::class);
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
}
