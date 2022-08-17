<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\sections;
use App\services;

class GuestController extends Controller
{
    public function GetTemp(){
        return view('landing');
    }
}