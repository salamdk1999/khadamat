<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try{
            $user = Socialite::driver($provider)->user();

        }catch(\Exception $e){
            return redirect()->route('login');
        }

        $authUser = $this->checkLogin($user);

        Auth::login($authUser);

        return redirect()->route('user');//عدلت بدل هوم
    }

    public function checkLogin($data){
        $authUser = User::where('provider_id',$data->id)->first();

        if($authUser){
            return $authUser;
        }

        $user=User::create([
            'name' => $data->name ?? $data->nickname,
            'email' => $data->email,
            'provider_id' => $data->id,
            'password' => encrypt('123456dummy'),
            'avatar' => $data->avatar
        ]);
        $user->assignRole('usr');//عطيت دور مستخدم اذا لما عمل لوغ ان المستخدم وما كان موجود بالداتا بيز
        return $user;
    }
}
