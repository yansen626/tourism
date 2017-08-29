<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Aug 2017 06:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserAdmin
 * 
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int $status_id
 * @property \Carbon\Carbon $created_on
 * @property string $created_by
 * @property \Carbon\Carbon $modified_on
 * @property string $modified_by
 * 
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class UserAdmin extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_id' => 'int'
	];

	protected $dates = [
		'created_on',
		'modified_on'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'first_name',
		'last_name',
		'status_id',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by'
	];

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}
}
