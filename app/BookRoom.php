<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRoom extends Model
{
    protected $casts = [
        'shifts' =>'array'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'status'];
}
