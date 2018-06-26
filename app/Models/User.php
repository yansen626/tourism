<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $about_me
 * @property string $phone
 * @property string $sex
 * @property string $nationality
 * @property \Carbon\Carbon $dob
 * @property string $current_location
 * @property string $id_card
 * @property string $passport_no
 * @property string $speaking_language
 * @property string $travel_interest
 * @property int $status_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $dates = ['dob'];

    protected $casts = [
        'id' => 'string',
        'status_id' => 'int'
    ];

    protected $fillable = [
        'id',
        'email',
        'password',
        'first_name',
        'last_name',
        'about_me',
        'phone',
        'sex',
        'nationality',
        'dob',
        'current_location',
        'id_card',
        'passport_no',
        'speaking_language',
        'travel_interest',
        'status_id',
        'email_token',
        'remember_token',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'email_token'
    ];
}
