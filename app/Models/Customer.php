<?php

namespace App\Models;

use App\Http\Controllers\CityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

}
