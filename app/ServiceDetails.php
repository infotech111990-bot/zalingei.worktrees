<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetails extends Model
{
  protected $table = "service_details";
  protected $fillable = ['service_id','title','titleEn','info','infoEn'];
}
