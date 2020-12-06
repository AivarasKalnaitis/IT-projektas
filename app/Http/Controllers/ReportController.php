<?php

namespace App\Http\Controllers;

use App\InsurancePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index',[
            'insurances' => InsurancePlan::all()
        ]);
    }

    public function generate(Request $request)
    {
        $this->validate($request, [
            'date_from' => ['sometimes', 'date', 'before:date_to'],
            'date_to' => ['sometimes', 'date', 'after:date_from'],
            'report' => ['required', 'string'],
            'insurance' => ['required', 'numeric'],
        ]);

        $query = DB::table('ordered_insurance_plans')
            ->select([
                'ordered_insurance_plans.approved',
                'ordered_insurance_plans.insurance_id',
                DB::raw('COUNT(insurance_id) as count'),
                DB::raw('SUM(insurance_plans.price) as total_price'),
            ])
            ->join('insurance_plans','insurance_plans.id','ordered_insurance_plans.insurance_id');

        if($request->has('date_from'))
            $query->whereDate('ordered_insurance_plans.created_at', '>=', $request->input('date_from'));

        if($request->has('date_to'))
            $query->whereDate('ordered_insurance_plans.created_at', '<=' ,$request->input('date_to'));

        if($request->input('report') === 'sold')
            $query->where('approved', '=',1);

        if($request->input('insurance') > 0)
            $query->where('insurance_id', '=',$request->input('insurance'));

        $d = $query->get();
        $data = $query->groupBy('insurance_id','approved')->get();
        $total = $data->count();

        dd($data, $total, $d);
        dd($query->get());
    }
}
