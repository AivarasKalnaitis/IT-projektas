<?php

namespace App\Http\Controllers;

use App\InsuranceHistory;
use App\InsurancePlan;
use App\OrderedInsurance;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderedInsuranceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $insurances = OrderedInsurance::with('user')->with('insurance');

        if (Gate::allows('get-all-insurances')) { $insurances = $insurances->get(); }
        else if (Gate::allows('get-not-approved-insurances')) { $insurances = $insurances->where('approved', 0)->get();}
        else $insurances = $insurances->where('user_id', auth()->user()->id)->get();

        return view('orders.index',[
            'insurances' => $insurances
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (Gate::denies('order-another-insurance')) {
            return redirect(route('home'));
        }

        $this->validate($request, [
            'insurance' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        OrderedInsurance::create([
            'insurance_id' => $request->insurance,
            'price' => $request->price,
            'user_id' => (int)auth()->user()->id,
        ]);

        InsuranceHistory::create([
            'insurance_id' => $request->insurance,
            'user_id' => (int)auth()->user()->id,
            'entry' => 'Užsakytas planas',
        ]);

        return redirect('/')->with('success', 'Planas užsakytas. Laukite patvirtinimo.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function extend(Request $request, $id)
    {
        $orderedInsurance = OrderedInsurance::where('insurance_id', $id)->where('user_id', (int)auth()->user()->id)->first();
        
        if ($orderedInsurance->valid_till > Carbon::now()->subMonth()) {
            return redirect()->back()->withErrors('Planą pratęsti galima tik likus mažiau negu 1 mėn. iki jo galiojimo pabaigos.');
        }
        
        $insurance = InsurancePlan::findOrFail($id);

        $validTill = Carbon::now()->addMonths($insurance->months_count);

        DB::table('ordered_insurance_plans')->where('id', $orderedInsurance->id)->update([
            'valid_till' => $validTill,
        ]);

        InsuranceHistory::create([
            'insurance_id' => $id,
            'user_id' => (int)auth()->user()->id,
            'entry' => 'Pratęstas planas',
        ]);

        return redirect()->back()->with('success', 'Pratęstas planas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OrderedInsurance $orderedInsurance
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(OrderedInsurance $insurance)
    {
        $insurance->delete();

        InsuranceHistory::create([
            'insurance_id' => $insurance->insurance()->first()->id,
            'user_id' => (int)auth()->user()->id,
            'entry' => 'Atsiakytas planas',
        ]);

        return redirect()->back()->with('success', 'Atsiakyta plano.');
    }

    public function approve ($id)
    {
        $months = DB::table('ordered_insurance_plans')
            ->select('months_count')
            ->leftJoin('insurance_plans', 'insurance_plans.id','ordered_insurance_plans.insurance_id')
            ->where('ordered_insurance_plans.id', $id)->pluck('months_count')->first();

        $validTill = Carbon::now()->addMonths($months);

        DB::table('ordered_insurance_plans')->where('id', $id)->update([
            'approved' => 1,
            'valid_till' => $validTill,
        ]);

        InsuranceHistory::create([
            'insurance_id' => OrderedInsurance::find($id)->insurance_id,
            'user_id' => (int)auth()->user()->id,
            'entry' => 'Patvirtintas planas',
        ]);

        return redirect()->back()->with('success', 'Patvirtinta, galioja iki: ' . $validTill);
    }
}
