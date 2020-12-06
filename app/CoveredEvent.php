<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoveredEvent extends Model
{
    public $timestamps = false;

    protected $table = 'insurance_covered_events';

    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class,'insurance_events','event_id', 'insurance_id');
    }
}
