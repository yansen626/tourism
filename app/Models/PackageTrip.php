<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 10 Jul 2018 12:47:13 +0000.
 */

namespace App\Models;

use Carbon\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PackageTrip
 * 
 * @property int $id
 * @property string $package_id
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property string $description
 * @property string $featured_image
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $updated_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Package $package
 *
 * @package App\Models
 */
class PackageTrip extends Eloquent
{
	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $appends = [
	    'start_date_string',
        'end_date_string'
    ];

	protected $fillable = [
		'package_id',
		'start_date',
		'end_date',
		'description',
		'featured_image',
		'created_by',
		'updated_by'
	];

	public function getStartDateStringAttribute(){
	    return Carbon::parse($this->attributes['start_date'])->format('d/m/Y G:i');
    }

    public function getEndDateStringAttribute(){
        return Carbon::parse($this->attributes['end_date'])->format('d/m/Y G:i');
    }

	public function package()
	{
		return $this->belongsTo(\App\Models\Package::class);
	}
}
