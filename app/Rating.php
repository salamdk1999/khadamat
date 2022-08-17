<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Rating extends Model
{

    protected $table='ratings';
    protected $fillable = ['user_id','services_id','stars_rated'];
    protected $hidden = [
        'created_at', 'updated_at',
        ];
    public $timestamp='true';

    public function service(){
        return $this->belongsTo('App\services','services_id','id');//الايدي لجدول السيرفز
}
}
