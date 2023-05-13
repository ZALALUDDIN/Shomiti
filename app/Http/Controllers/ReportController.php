<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    
    public function index(Request $request)
    {
        $isAjaxCall = $request->ajax();
    
        if ($isAjaxCall) {
            $query = DB::table('receives')
                ->join('members', 'members.id', 'receives.member_id')
                ->join('years', 'years.id', 'receives.year_id')
                ->join('months', 'months.id', 'receives.month_id')
                ->select('receives.*', 'members.name', 'years.year', 'months.month');
    
            // Check if the request has a start date and end date
            if ($request->has('start-date') && $request->has('end-date')) {
                $startDate = $request->input('start-date');
                $endDate = $request->input('end-date');
    
                // Add a where clause to filter the results by date range
                $query->whereBetween('receives.paymentDate', [$startDate, $endDate]);
            }
    
            $data = $query->paginate();
    
            return response()->json($data);
        }
    
        return view('report');
    }
}

