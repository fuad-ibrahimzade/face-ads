<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessMark extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'activity', 'sector', 'city',
        'pricing',
    ];
    protected $casts = [
        'sector' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'email','email');
    }
    public function smmservices()
    {
        return SMMService::where('business_mark_id',$this->id)->get();
    }
}
