<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceEvent extends Model
{
    protected $table = 'insurance_events';

    protected $fillable = [
        'event_id', 'insurance_id'
    ];

    public $timestamps = false;

    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    public function parameter()
    {
        return $this->belongsTo(CoveredEvent::class);
    }
}
