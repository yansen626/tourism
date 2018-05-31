<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $casts = [
        'id' => 'string'
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
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'email_token'
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
