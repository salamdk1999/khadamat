<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class services extends Model
{
    use SoftDeletes;


    protected $fillable = ['name', 'description', 'section_id', 'status', 'Value_status', 'price' ,'image','service_provider_id'];
    protected $date = ['deleted_at'];

    public function section()
    {
        return $this->belongsTo('App\sections');
    }

    public function provider()
    {
        return $this->hasOne('App\User', 'id', 'service_provider_id');
    }


    public function orders()
    {
        return $this->hasMany('App\orders')->withTrashed();
    }
    public function ratings(){
        return $this -> hasMany('App\Rating','services_id','id');
    }
}