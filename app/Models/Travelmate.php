<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 28 Jun 2018 03:06:42 +0000.
 */

namespace App\Models;

use App\Notifications\TravelmateResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Travelmate
 * 
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int $total_point
 * @property int $rating
 * @property int $city_id
 * @property int $province_id
 * @property string $description
 * @property string $address
 * @property string $postal_code
 * @property int $total_review
 * @property string $occupation
 * @property string $about_me
 * @property string $phone
 * @property string $sex
 * @property string $nationality
 * @property \Carbon\Carbon $dob
 * @property string $current_location
 * @property string $id_card
 * @property string $passport_no
 * @property string $driving_license
 * @property string $speaking_language
 * @property string $travel_interest
 * @property string $profile_picture
 * @property string $banner_picture
 * @property string $ktp_img
 * @property int $status_id
 * @property \Carbon\Carbon $created_at
 * @property string $created_by
 * @property \Carbon\Carbon $updated_at
 * @property string $updated_by
 * 
 * @property \App\Models\City $city
 * @property \App\Models\Province $province
 * @property \App\Models\Status $status
 * @property \Illuminate\Database\Eloquent\Collection $packages
 *
 * @package App\Models
 */
class Travelmate extends Authenticatable
{
    use Notifiable;

    protected $guard = 'travelmates';
    protected $table = 'travelmates';
	public $incrementing = false;

    protected $appends = [
        'dob_string'
    ];

	protected $casts = [
		'total_point' => 'int',
		'rating' => 'int',
		'city_id' => 'int',
		'province_id' => 'int',
		'total_review' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'dob'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
	    'id',
		'email',
		'password',
		'first_name',
		'last_name',
		'total_point',
		'rating',
		'city_id',
		'province_id',
		'address',
		'postal_code',
		'occupation',
		'description',
		'total_review',
		'about_me',
		'phone',
		'sex',
		'nationality',
		'dob',
		'current_location',
		'id_card',
		'passport_no',
		'driving_license',
		'speaking_language',
		'travel_interest',
		'profile_picture',
		'banner_picture',
        'remember_token',
        'ktp_img',
		'status_id',
		'created_by',
		'updated_by'
	];

    public function getDobStringAttribute(){
        return Carbon::parse($this->attributes['dob'])->format('d M Y');
    }

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

	public function packages()
	{
		return $this->hasMany(\App\Models\Package::class);
	}

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TravelmateResetPasswordNotification($token));
    }
}
