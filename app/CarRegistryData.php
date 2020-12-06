<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarRegistryData extends Model
{
    public $table = 'car_data_registry';

    protected $fillable = [
        'car_number',
        'first_registration_country',
        'insurance_events_count'
    ];

    public function carData()
    {
        return $this->belongsToMany(CarParameter::class,'table_parameters_car_data_pivot','car_data_id', 'parameter_id');
    }
}
