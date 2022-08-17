<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View ;
use Illuminate\Support\Facades\DB;
use App\sections;
use App\services;
use App\User;

class headerComposer
{
    private $subsections;
    public function __construct() {


    }


    public function compose(View $view){
        $mainsections=DB::table('sections')->whereNull('parent_id')->get();
        $view->with('mainsections',$mainsections);



    }
}
