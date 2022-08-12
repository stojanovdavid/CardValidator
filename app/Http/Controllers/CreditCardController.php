<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditCardController extends Controller
{
    public function store(Request $request){
        if($request->card_type == "default"){
            $creditentials = $this->validate($request, [
                'card_type' => 'required',
                'full_name' => 'required',
                'card_number' => 'required',
                'cvv' => 'required|integer|digits:3'
            ]);
        }
        
        if($request->card_type == "american"){
            $this->validate($request, [
                'full_name' => 'required',
                'card_number' => 'required',
                'cvv' => 'required|integer|digits:4'
            ]);
            $first_two = substr($request->card_number,0, 2);
            if($first_two != "34" || $first_two != "37"){
                return back()->with('PAN_error', 'The american express card must start with \' 34 \' or \' 37\' ');
            }
        }


        $string = strtotime($request->ccyear . '-' .$request->ccmonth . '-' . date('d'));
        $now = strtotime(date('Y-m-d'));
        if($string < $now){
            return back()->with('message', 'Expiry date must be AFTER present time');
        }
        DB::table('credit_card')->insert([
            'full_name' => $request->full_name,
            'PAN' => $request->card_number,
            'CVV' => $request->cvv,
            'exp_date' => $request->ccmonth . '/' . $request->ccyear,
        ]);
    }
}
