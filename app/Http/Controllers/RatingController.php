<?php

namespace App\Http\Controllers;

use App\orders;
use App\services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Random;

class RatingController extends Controller
{
    public function add(Request $request){
        $id=Auth::user()->id;
        $stars_rated=$request -> input('service_rating');
        $services_id=$request -> input('service_id');
        $service_check=services::where('id',$services_id)->first();
        if($service_check){
            $verifed_purchace=orders::where('user_id',$id)->where('service_id',$services_id)->where('Value_PaymentStatus',1)->first();
            if($verifed_purchace){
                $existing_rating=Rating::where('user_id',$id)->where('services_id',$services_id)->first();
                if($existing_rating){
                    $existing_rating -> stars_rated = $stars_rated;
                    $existing_rating ->update();
                }else{
                    Rating::create([
                        'user_id' => $id,
                        'services_id'=>$services_id,
                        'stars_rated'=>$stars_rated,
                    ]);
                }
                return redirect()->back()->with('buyer_rate',"شكرا على تقييم الخدمة");
            }else{
                return redirect()->back()->with('user_rate','لا يمكنك تقييم الخدمة قبل شراءها');
            }
        }else{
            return redirect()->back()->with('no_rate',"الرابط غير متوفر");
        }
    }
}
