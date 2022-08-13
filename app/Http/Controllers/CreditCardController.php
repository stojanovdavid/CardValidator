<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditCardController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'card_type' => 'required',
            'full_name' => 'required',
            'card_number' => 'required',
            'cvv' => 'required|integer'
        ]);

            
        $credit_card = new CreditCard();


        if($request->card_type == "american"){
            if(!$credit_card->american_express_card_validator_length($request->card_type, $request->card_number)){
                return back()->with('PAN_error', 'The american express card must start with " 34 " or "37" ');
            }
    
            if(!$credit_card->american_express_card_valitator_cvv($request->card_type, $request->cvv)){
                return back()->with('cvv_error', 'The american CVV must be 4 characters long');
            }
        }

        if($request->card_type == "default"){
            if(!$credit_card->default_card_validator($request->card_type, $request->cvv)){
                return back()->with('cvv_error', 'The card\'s CVV must be 3 characters long');
            }
        }

        if(!$credit_card->check_length($request->card_number)){
            return back()->with('PAN_error_length', 'Must be between 16 and 19 characters long');
        }
        if(!$credit_card->check_exp_date($request->ccyear, $request->ccmonth)){
            back()->with('message', 'Expiry date must be AFTER present time');
        }
        if(!$credit_card->luhns_alghorithm($request->card_number)){
            return back()->with('luhn_validation', 'This credit card number is not valid');
        }

        
        DB::table('credit_card')->insert([
            'full_name' => $request->full_name,
            'PAN' => $request->card_number,
            'CVV' => $request->cvv,
            'exp_date' => $request->ccmonth . '/' . $request->ccyear,
        ]);

        return back()->with('success', 'Your payment was successfull');

    }
}
