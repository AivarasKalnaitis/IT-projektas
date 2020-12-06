<?php

namespace App\Http\Controllers;

use App\CarParameter;
use App\CoveredEvent;
use App\Filters\InsuranceFilter;
use App\InsurancePlan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Input;

class InsurancePlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param InsuranceFilter $filters
     * @return Application|Factory|Response|View
     */
    public function index(Request $request, InsuranceFilter $filters)
    {
        $insurancePlans = InsurancePlan::filter($filters)->paginate(8);
        
        session()->flashInput($request->input());

        return view('insurance-plan.index',[
            'insurancePlans' => $insurancePlans,
            'carId' => $request->input('car_id'),
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function create()
    {
        if (Gate::denies('control-insurance')) {
            return redirect(route('home'));
        }

        return view('insurance-plan.create',[
            'carParams' => CarParameter::all(),
            'events' => CoveredEvent::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (Gate::denies('control-insurance')) {
            return redirect(route('home'));
        }


        $attributes = $this->validate($request, [
            'name' => ['required', 'string'],
            'price' => ['sometimes','numeric', 'between:1,100'],
            'years_of_experience' => ['required','numeric', 'between:0,100'],
            'months_count' => ['required', 'in:3,6,12'],
            'events' => ['array', 'required'],
            'events.*' => ['numeric'],
            'power' => ['required'],
            'engine' => ['required'],
            'discount' => [''],
        ]);

        $plan = InsurancePlan::create([
            'name' => $attributes['name'],
            'years_of_experience' => $attributes['years_of_experience'],
            'months_count' => $attributes['months_count'],
            'discount' => $attributes['discount'] == "on" ? true : false,
        ]);

        $powerId = CarParameter::where('value', '=', $attributes['power'])->pluck('id')->first();
        $engineId = CarParameter::where('value', '=', $attributes['engine'])->pluck('id')->first();
        $plan->parameters()->attach($powerId);
        $plan->parameters()->attach($engineId);
        $plan->coveredEvents()->attach($attributes['events']);

        return redirect('/')->with('success', 'Insurance plan created');
    }

    /**
     * Display the specified resource.
     *
     * @param InsurancePlan $insurancePlan
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show(InsurancePlan $insurancePlan)
    {
        if (Gate::denies('order-another-insurance')) {
            return redirect(route('home'));
        }

        return view('insurance-plan.show',[
            'insurance' => $insurancePlan,
            'parameters' => $insurancePlan->parameters()->get(),
            'events' => $insurancePlan->coveredEvents()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InsurancePlan $insurancePlan
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(InsurancePlan $insurancePlan)
    {
        if (Gate::denies('control-insurance')) {
            return redirect(route('home'));
        }

        // grazina visas variklio turio reiksmes masyvu
        // dd(CarParameter::where('parameter', '=', 'Variklio tūris')->pluck('value'));

        // grazina input su power ir engine reiksmem masyvy
        //dd($insurancePlan->parameters()->get()->pluck('value'));


        return view('insurance-plan.edit',[
            'insurancePlan' => $insurancePlan,
            'carParams' => CarParameter::all(),
            'events' => CoveredEvent::all(),
            'power' =>  CarParameter::where('parameter', '=', 'Galia')->where('value', '=', $insurancePlan->parameters()->get()->pluck('value'))->pluck('value')->first(),
            'engine' =>  $insurancePlan->parameters()->get()->pluck('value')[1],
            'selected' => $insurancePlan->parameters()->get()->pluck('id'),
            'selectedE' => $insurancePlan->coveredEvents()->get()->pluck('id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector|void
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('control-insurance')) {
            return redirect(route('home'));
        }

        $plan = InsurancePlan::findOrFail($id);

        $attributes = $this->validate($request, [
            'name' => ['required', 'string'],
            'price' => ['sometimes','numeric', 'between:1,100'],
            'years_of_experience' => ['required','numeric', 'between:0,100'],
            'months_count' => ['required', 'in:3,6,12'],
            'power' => ['required'],
            'engine' => ['required'],
            'events' => ['array', 'required'],
            'events.*' => ['numeric'],
            'discount' => ['']
        ]);
        

        $plan->update([
            'name' => $attributes['name'],
            'years_of_experience' => $attributes['years_of_experience'],
            'months_count' => $attributes['months_count'],
            'discount' => isset($attributes['discount']) ? true : false,
        ]);
        
        $powerId = CarParameter::where('value', '=', $attributes['power'])->pluck('id')->first();
        $engineId = CarParameter::where('value', '=', $attributes['engine'])->pluck('id')->first();
         
    
        $plan->parameters()->sync([$powerId, $engineId]);
        $plan->coveredEvents()->sync($attributes['events']);

        return redirect('/')->with('success', 'Insurance plan updated');;
    }


    public function summary()
    {
        $plans = InsurancePlan::withCount('orderdPlans')->get();
        return view('summary', [
            'plans' => $plans,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InsurancePlan $insurancePlanModel
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(int $id)
    {
        InsurancePlan::destroy($id);

        return redirect()->route('home');
    }
}
