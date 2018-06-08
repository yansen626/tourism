<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Jun 2018 07:29:07 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TransactionDetail
 * 
 * @property string $id
 * @property string $header_id
 * @property string $package_id
 * @property float $price
 * @property int $discount_percent
 * @property float $discount_flat
 * @property float $subtotal
 * @property string $note
 * @property string $updated_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Package $package
 * @property \App\Models\TransactionHeader $transaction_header
 *
 * @package App\Models
 */
class TransactionDetail extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'discount_percent' => 'int',
		'discount_flat' => 'float',
		'subtotal' => 'float'
	];

	protected $fillable = [
		'header_id',
		'package_id',
		'price',
		'discount_percent',
		'discount_flat',
		'subtotal',
		'note',
		'updated_by'
	];

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}

	public function transaction_header()
	{
		return $this->belongsTo(\App\Models\TransactionHeader::class, 'header_id');
	}
}
