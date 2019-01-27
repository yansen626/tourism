<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Jul 2018 15:36:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Package
 * 
 * @property string $id
 * @property string $travelmate_id
 * @property string $name
 * @property string $category_id
 * @property int $province_id
 * @property int $city_id
 * @property string $location_detail
 * @property float $price
 * @property int $duration
 * @property string $description
 * @property string $meeting_point
 * @property int $max_capacity
 * @property string $featured_image
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
 * @property \Illuminate\Database\Eloquent\Collection $package_prices
 * @property \Illuminate\Database\Eloquent\Collection $package_trips
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
		'duration' => 'int',
		'price' => 'float',
		'status_id' => 'int',
		'max_capacity' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'id',
		'travelmate_id',
		'name',
		'category_id',
		'province_id',
		'city_id',
		'location_detail',
		'price',
		'duration',
		'description',
		'meeting_point',
		'max_capacity',
		'featured_image',
		'start_date',
		'end_date',
		'status_id',
		'created_by',
		'updated_by'
	];

//    public function getPriceAttribute(){
//        return number_format($this->attributes['price'], 0, ",", ".");
//    }

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
		return $this->hasMany(\App\Models\Cart::class);
	}

	public function package_images()
	{
		return $this->hasMany(\App\Models\PackageImage::class);
	}

	public function package_prices()
	{
		return $this->hasMany(\App\Models\PackagePrice::class);
	}

	public function package_trips()
	{
		return $this->hasMany(\App\Models\PackageTrip::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(\App\Models\TransactionDetail::class);
	}
}
