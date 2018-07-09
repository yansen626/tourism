<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Jun 2018 07:28:59 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TransactionHeader
 * 
 * @property string $id
 * @property string $user_id
 * @property int $payment_method_id
 * @property string $va_bank
 * @property string $va_number
 * @property string $bill_key
 * @property string $biller_code
 * @property string $invoice
 * @property string $order_id
 * @property int $payment_code
 * @property int $voucher_id
 * @property float $total_payment
 * @property float $total_price
 * @property string $postal_code
 * @property string $address_detail
 * @property float $admin_fee
 * @property int $status_id
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $updated_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\PaymentMethod $payment_method
 * @property \App\Models\Status $status
 * @property \App\Models\User $user
 * @property \App\Models\Voucher $voucher
 * @property \Illuminate\Database\Eloquent\Collection $transaction_details
 * @property \Illuminate\Database\Eloquent\Collection $transfer_confirmations
 *
 * @package App\Models
 */
class TransactionHeader extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'payment_method_id' => 'int',
		'payment_code' => 'int',
		'total_payment' => 'float',
		'total_price' => 'float',
		'admin_fee' => 'float',
		'status_id' => 'int',
		'voucher_id' => 'int'
	];

	protected $fillable = [
		'id',
		'user_id',
		'payment_method_id',
		'va_bank',
		'va_number',
		'bill_key',
		'biller_code',
		'invoice',
		'order_id',
		'voucher_id',
		'total_payment',
		'total_price',
		'postal_code',
		'address_detail',
		'admin_fee',
		'status_id',
		'created_by',
		'updated_by'
	];

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
	public function voucher()
	{
		return $this->belongsTo(\App\Models\Voucher::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(\App\Models\TransactionDetail::class, 'header_id');
	}

	public function transfer_confirmations()
	{
		return $this->hasMany(\App\Models\TransferConfirmation::class, 'transaction_id');
	}
}
