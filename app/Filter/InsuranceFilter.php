<?php

namespace App\Filters;

use App\InsurancePlan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InsuranceFilter extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function years_of_experience($term)
    {
        return $this->builder->where('insurance_plans.years_of_experience', '<=', $term);
    }

    public function name($term)
    {
        return $this->builder->where('insurance_plans.name', 'LIKE', "%$term%");
    }
}
