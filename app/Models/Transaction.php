<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Transaction
 * 
 * @property string $id
 * @property string $user_id
 * @property int $payment_method_id
 * @property int $payment_code
 * @property float $total_payment
 * @property float $total_price
 * @property int $address_id
 * @property int $courier_id
 * @property int $delivery_type_id
 * @property float $delivery_fee
 * @property float $admin_fee
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_on
 * @property string $modified_by
 * @property \Carbon\Carbon $modified_on
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\Courier $courier
 * @property \App\Models\DeliveryType $delivery_type
 * @property \App\Models\PaymentMethod $payment_method
 * @property \App\Models\Status $status
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $transaction_details
 *
 * @package App\Models
 */
class Transaction extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'payment_method_id' => 'int',
		'payment_code' => 'int',
		'total_payment' => 'float',
		'total_price' => 'float',
		'address_id' => 'int',
		'courier_id' => 'int',
		'delivery_type_id' => 'int',
		'delivery_fee' => 'float',
		'admin_fee' => 'float',
		'status_id' => 'int'
	];

	protected $dates = [
		'created_on',
		'modified_on'
	];

	protected $fillable = [
		'user_id',
		'payment_method_id',
		'payment_code',
		'total_payment',
		'total_price',
		'address_id',
		'courier_id',
		'delivery_type_id',
		'delivery_fee',
		'admin_fee',
		'status_id',
		'created_by',
		'created_on',
		'modified_by',
		'modified_on'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class);
	}

	public function courier()
	{
		return $this->belongsTo(\App\Models\Courier::class);
	}

	public function delivery_type()
	{
		return $this->belongsTo(\App\Models\DeliveryType::class);
	}

	public function payment_method()
	{
		return $this->belongsTo(\App\Models\PaymentMethod::class);
	}

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(\App\Models\TransactionDetail::class);
	}
}