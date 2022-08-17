<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachments_order extends Model
{
    protected $fillable = [ 'file_name','order_number','Created_by','order_id'];


}
