<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    protected $fillable = [
        'sector', 'email'
    ];
//    protected $casts = [
//        'pricing' => 'array',
//    ];
    public function user()
    {
        return $this->belongsTo('App\User','email','email');
    }
}
