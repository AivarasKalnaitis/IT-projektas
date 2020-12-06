<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedInsurance extends Model
{
    protected $table = 'ordered_insurance_plans';

    protected $visible = ['id', 'insurance_id', 'approved', 'price', 'user_id', 'updated_at', 'created_at'];

    protected $fillable = [
        'approved', 'user_id', 'insurance_id', 'valid_till', 'price'
    ];

    public function insurance()
    {
        return $this->belongsTo(InsurancePlan::class, 'insurance_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
