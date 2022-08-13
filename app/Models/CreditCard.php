<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $table = "credit_card";
    protected $fillable = [
        'full_name',
        'PAN',
        'CVV',
        'exp_date'
    ];


    public function check_length($number){
        if($number){
            $trimmed = str_replace(' ', '', $number);
            if(strlen($trimmed) < 16 || strlen($trimmed) > 19){
                return false;
            }else{
                return true;
            }

        }
    }

    public function check_exp_date($year, $month){
        $string = strtotime($year . '-' .$month . '-' . date('d'));
        $now = strtotime(date('Y-m-d'));
        if($string < $now){
            return false;
        }else{
            return true;
        }
    }

    public function american_express_card_validator_length($card_type, $card_number){
        if($card_type == "american"){
            $first_two = substr($card_number,0, 2);
            if($first_two != "34" && $first_two != "37"){
                return false;
            }else{
                return true;
            }
        }
        return true;
    }

    public function american_express_card_valitator_cvv($card_type, $cvv){
        if(strlen($cvv) != 4){
            return false;
        }else{
            return true;
        }
    }

    public function default_card_validator($card_type, $cvv){
        if(strlen($cvv) != 3){
            return false;
        }else{
            return true;
        }
    }

    public function luhns_alghorithm($card_number){
        if($card_number){
            $trimmed = str_replace(' ', '', $card_number);
            if(strlen($trimmed) % 2 == 0){
                $to_arr = str_split($trimmed);
                $total = 0;
                $i=1;
                $number = array_reverse($to_arr);
    
                foreach($number as $digit){
    
                    if($i % 2 == 0){
                        $digit*=2;
    
    
                        if($digit > 9){
    
                            $digit-=9;
                        }
                    }
    
                    $total+=$digit;
                    $i++;
    
                }

                
                if($total % 10 != 0){
                    return false;
                }else{
                    return true;
                }
            }
            
            if(strlen($trimmed) % 2 == 1){
                $number = str_split($trimmed);
                $total = 0;
                $i=1;
                
                foreach($number as $digit){
                    
                    if($i % 2 == 0){
                        $digit*=2;
                        
                        
                        if($digit > 9){
                            
                            $digit-=9;
                        }
                    }
                    
                    $total+=$digit;
                    $i++;
                    
                }
                if($total % 10 != 0){
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
}
