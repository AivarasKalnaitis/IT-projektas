<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarParameter extends Model
{
    public $timestamps = false;

    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class,'parameter_insurance','parameter_id', 'insurance_id');
    }

    public function carData()
    {
        return $this->belongsToMany(CarRegistryData::class,'table_parameters_car_data_pivot','parameter_id', 'car_data_id');
    }

}
