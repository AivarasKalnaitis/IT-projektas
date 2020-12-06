<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Mockery\Generator\Parameter;

class CarRegistryParameter extends Pivot
{
    protected $table = 'table_parameters_car_data_pivot';

    protected $fillable = [
        'parameter_id', 'car_data_id'
    ];

    public $timestamps = false;

    public function parameters()
    {
        return $this->belongsTo(CarParameter::class);
    }

    public function carData()
    {
        return $this->belongsTo(Parameter::class);
    }
}
