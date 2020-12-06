<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ParameterInsurance extends Pivot
{
    protected $table = 'parameter_insurance';

    protected $fillable = [
        'parameter_id', 'insurance_id'
    ];

    public $timestamps = false;

    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    public function parameter()
    {
        return $this->belongsTo(CarParameter::class);
    }
}
