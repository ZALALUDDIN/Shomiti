<?php

namespace App\Http\Controllers;

use App\Models\Receive;
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
        return view('payTable.receivedList', compact('pay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payer=Receive::all();
        return view('payTable.received', compact('payer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $m= new Receive();
            $m->memberName = $request->member;
            $m->paymentName = $request->category;
            $m->month = $request->monthName;
            $m->year = $request->year;
            $m->amount = $request->payAmount;
            $m->paymentDate = $request->date;

            $m->save();
            return redirect(route('payment.index'));
            }
            catch (Exception $error) {
            //dd($error);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receive $receive)
    {
        //
    }
}
