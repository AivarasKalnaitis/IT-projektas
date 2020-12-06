<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static withCount(string $string)
 * @method static findOrFail($id)
 * @method static create(array $attributes)
 * @method static filter(Filters\InsuranceFilter $filters)
 */
class InsurancePlan extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'years_of_experience',
        'insurance_covered_events',
        'name',
        'months_count',
        'power',
        'engine',
        'discount'
    ];

    protected $casts = [
        'discount' => 'boolean',
    ];

    protected $visible = ['id','name','price', 'years_of_experience', 'insurance_covered_events', 'months_count', 'power', 'engine', 'discount'];

    public function parameters()
    {
        return $this->belongsToMany(CarParameter::class,'parameter_insurance','insurance_id', 'parameter_id');
    }

    public function coveredEvents()
    {
        return $this->belongsToMany(CoveredEvent::class,'insurance_events','insurance_id', 'event_id');
    }

    public function orderdPlans()
    {
        return $this->hasMany(OrderedInsurance::class, 'insurance_id');
    }
}
