<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Receive;
use App\Models\Year;
use App\Models\Month;
use Exception;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pay=Receive::all();
        $member=Member::all();
        $year=Year::all();
        $month=Month::all();
        return view('payTable.receivedList', compact('pay','member', 'year', 'month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payer=Member::all();
        $year=Year::all();
        //$month=Month::all();
        return view('payTable.received', compact('payer', 'year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//     public function create()
//     {
//         $payer=Member::all();
//         $year=Year::all();
//         //$month=Month::all();
//         return view('payTable.receivednew', compact('payer', 'year'));
//     }



    public function store(Request $request)
    {
        try{
            ($request);
            $m= new Receive();
            $m->member_id = $request->member;
            $m->year_id = $request->year;
            $m->month_id = $request->month;
            $m->amount = $request->paid + $request->dueAmount;
            $m->due = $request->dueAmount;
            $m->receipt = $request->receipt_no;
            $m->paymentDate = now();
            $m->save();


 $receive = Receive::find(1);
            if ($receive->isPaid()) {
                // Payment has been made
            } else {
                // Payment has not been made
            }


            
            return redirect(route('payment.index'));
            }
            catch (Exception $error) {
            dd($error);
            return redirect()->back()->withInput();
            }

           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show(Receive $receive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(Receive $receive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receive $receive)
{
    // Validate the request data
    $request->validate([
        'dueAmount' => 'required',
    ]);

    // Update the payment with the new data
    $receive->due = $request->input('dueAmount');
    $receive->save();

    // Redirect back to the original page with a success message
    return redirect()->back()->with('success', 'Due payment updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Receive::find($id)->delete();
        return redirect()->back();

    }



    public function get_month(Request $request)
    {
        $get_month = Month::find($request->id)->get();
        return $get_month;
    }

    public function get_payable(Request $request){
		$get_payable = Member::find($request->id)->get();
		return $get_payable;
	}
}

