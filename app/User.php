<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'car_number',
        'first_registration_country',
        'insurance_events_count',
        'engine',
        'power'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class,'user_role','user_id', 'role_id');
    }

    public function insurances()
    {
        return $this->hasMany(OrderedInsurance::class);
    }

    public function isAdmin()
    {
        return in_array(1, $this->role()->pluck('role_id')->all());
    }

    public function isManager()
    {
        return in_array(2, $this->role()->pluck('role_id')->all());
    }

    public function isSimpleUser()
    {
        return in_array(3, $this->role()->pluck('role_id')->all());
    }

    public function hasOrderedPlan()
    {
        return $this->insurances()->count() > 0;
    }

    public function calculatePrice(int $insurancePlanId)
    {
        $carData = CarRegistryData::with('carData')->where('car_number', $this->car_number)->first();
        $insurancePlan = InsurancePlan::find($insurancePlanId);

        $exp = $insurancePlan->years_of_experience ?? 0;
        $duration = $insurancePlan->months_count ?? 6;
        $numberOfCoverages = $insurancePlan->coveredEvents()->get()->count() ?? 4;
        $numberOfEvents = $carData->insurance_events_count ?? 5;
        $power = (isset($carData)) ? $carData->carData()->where('parameter','Galia')->get()->pluck('value')->first() : 100 + $this->id;
        $engine = (isset($carData)) ? $carData->carData()->where('parameter','Variklio tūris')->get()->pluck('value')->first() : 100 + $this->id;

        $price =  (( ($power * $engine) - ($exp * 1.45) ) * ($numberOfEvents * 1.15 + $numberOfCoverages * 1.55)) / ($duration * 2.5);

        return number_format(round($price,2),2);
    }

    public function calculatePriceGuest($numberOfEvents, $power, $engine, int $insurancePlanId)
    {
        $insurancePlan = InsurancePlan::find($insurancePlanId);

        $events = ($numberOfEvents != 0) ? $numberOfEvents : 0.5;
        $exp = $insurancePlan->years_of_experience ?? 0;
        $duration = $insurancePlan->months_count ?? 3;
        $numberOfCoverages = $insurancePlan->coveredEvents()->get()->count() ?? 5;

        $price =  (( $power * $engine - ($exp * 1.25) ) * ($events * 1.15 + $numberOfCoverages * 1.55)) / ($duration * 2.5);

        return number_format(round($price,2),2);
    }

    public function applyDiscount($insurancePlanId)
    {
        $insurancePlan = InsurancePlan::find($insurancePlanId);
        $carData = CarRegistryData::with('carData')->where('car_number', $this->car_number)->first();

        $price = $this->calculatePrice($insurancePlanId);
        $numberOfEvents = $carData->insurance_events_count ?? 5;
        $numberOfCoverages = $insurancePlan->coveredEvents()->get()->count() ?? 5;

        $discount = ($price - ($numberOfEvents * $numberOfCoverages)) / 10;
        

        return number_format(round($discount,2),2);
    }

    public function canRejectPlan(int $planId)
    {
        return $this->insurances()->where('insurance_id', $planId)->where('approved', 0)->exists();
    }

    public function canExtendPlan(int $planId)
    {
        return $this->insurances()->where('insurance_id', $planId)->where('approved', 1)->exists();
    }

    public function getHowLongPlanIsVallid(int $planId)
    {
        return $this->insurances()->where('insurance_id', $planId)->where('approved', 1)->first()->valid_till;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function($user) {
            $role = Role::where('name','=','User')->pluck('id')->first();

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role
            ]);

            CarRegistryData::create([
                'car_number' => $user->car_number,
                'first_registration_country' => $user->first_registration_country,
                'insurance_events_count' => $user->insurance_events_count
            ]);

            $car_id = CarRegistryData::where('car_number', '=', $user->car_number)->pluck('id')->first();
            $parameter_id_power = CarParameter::where('value', '=', $user->power)->pluck('id')->first();
            $parameter_id_engine = CarParameter::where('value', '=', $user->engine)->pluck('id')->first();

            CarRegistryParameter::create([
                'car_data_id' => $car_id,
                'parameter_id' => $parameter_id_power
            ]);

            CarRegistryParameter::create([
                'car_data_id' => $car_id,
                'parameter_id' => $parameter_id_engine
            ]);
        });
    }
}
