<?php

namespace App\Http\Controllers;

use App\orders;
use App\services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\Review;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Random;

class ReviewController extends Controller
{
    public function add($service_id){
        $id=Auth::user()->id;
        $service=services::where('id',$service_id)->first();
        if($service){
            $review= Review::where('user_id',$id)->where('service_id',$service_id)->first();
            if($review){
                return view('reviews.edit',compact('review'));
            }else{
            $verifed_purchace=orders::where('user_id',$id)->where('service_id',$service_id)->where('Value_PaymentStatus',1)->first();
            return view('reviews.index',compact('service','verifed_purchace'));
            }
        }else{
            return redirect()->back()->with('no_rate',"الرابط غير متوفر");
        }
    }
    public function create(Request $request){
        $id=Auth::user()->id;
        $service_id=$request->input('service_id');
        $service=services::where('id',$service_id)->first();
        if($service){
            $user_review=$request->input('user_review');
            $new_review = Review::create([
                'user_id' => $id,
                'service_id'=>$service_id,
                'user_review'=>$user_review,
            ]);
            if($new_review){
                return redirect('profile/'.$service->id.'/'.$service -> provider -> id)->with('buyer_review',"شكرا لك على المراجعة");
            }
        }else{
            return redirect()->back()->with('no_rate',"الرابط غير متوفر");
        }
    }
    public function edit($service_id){
        $id=Auth::user()->id;
        $service=services::where('id',$service_id)->first();
        if($service){
            $review=Review::where('user_id',$id)->where('service_id',$service_id)->first();
            if($review){
                return view('reviews.edit',compact('review'));
            }else{
                return redirect()->back()->with('no_rate',"الرابط غير متوفر");
            }
        }else{
            return redirect()->back()->with('no_rate',"الرابط غير متوفر");
        }
    }
    public function update(Request $request){
        $user_review = $request->input('user_review');
        if($user_review != ''){
            $review_id = $request->input('review_id');
            $review = Review::where('id',$review_id)->where('user_id',Auth::user()->id)->first();
            if($review){
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('profile/'.$review->service->id.'/'.$review->service->provider->id)->with('update_review',"تم تعديل المراجعة بنجاح");
            }else{
                return redirect()->back()->with('no_rate',"الرابط غير متوفر");
            }
        }else{
            redirect()->back()->with('no_update_review',"لا يمكن تعديل مراجعة فارغة");
        }
    }
}