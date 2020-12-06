<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceHistory extends Model
{
    protected $fillable = [
        'user_id', 'insurance_id', 'entry'
    ];

    public $table='insurances_history';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function insurance()
    {
        return $this->belongsTo(InsurancePlan::class, 'insurance_id');
    }
}
