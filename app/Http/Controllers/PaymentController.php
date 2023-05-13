<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Retrieve payment data for the specified user
        $payments = Payment::where('name', $name)
            ->where('email', $email)
            ->where('phone', $phone)
            ->get();

        // Render the payment data as an HTML fragment
        $html = view('payment.index', ['payments' => $payments])->render();

        return response()->json(['html' => $html]);
    }
    public function checkPayment(Request $request)
    {
        $year = $request->year;
        $member_id = $request->member_id;
        $months = Payment::where('year_id', $year)->where('member_id', $member_id)->pluck('month_id');
        $options = '<option value="">--- Select Month ---</option>';
        $month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        foreach($month_names as $key => $month_name) {
            $option_value = $key + 1;
            if($months->contains($option_value)) {
                $options .= '<option value="'.$option_value.'" disabled>'.$month_name.' (Paid)</option>';
            } else {
                $options .= '<option value="'.$option_value.'">'.$month_name.'</option>';
            }
        }
        if($options === '<option value="">--- Select Month ---</option>') {
            return response()->json('no-data');
        } else {
            return response()->json($options);
        }
    }

}
