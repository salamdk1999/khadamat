<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table='reviews';
    protected $fillable = ['user_id','service_id','user_review'];
    protected $hidden = [
        'created_at', 'updated_at',
        ];
    public $timestamp='true';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function rating(){
        return $this->belongsTo('App\Rating','user_id','user_id');
    }

    public function service(){
        return $this->belongsTo('App\services','service_id','id');
    }

}