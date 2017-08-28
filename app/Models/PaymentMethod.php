<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentMethod
 * 
 * @property int $id
 * @property string $description
 * @property float $fee
 * 
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 *
 * @package App\Models
 */
class PaymentMethod extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fee' => 'float'
	];

	protected $fillable = [
		'description',
		'fee'
	];

	public function transactions()
	{
		return $this->hasMany(\App\Models\Transaction::class);
	}
}
