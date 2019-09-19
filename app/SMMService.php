<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMMService extends Model
{
    //
    protected $fillable = [
        'pricing', 'services_for_price','email'
    ];
//    protected $casts = [
//        'pricing' => 'array',
//    ];
    public function user()
    {
        return $this->belongsTo('App\User','email','email');
    }
    public function businessMark()
    {
//        return $this->belongsToM('App\User','email','email');
//        $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
        return $this->belongsTo('App\BusinessMark', 'business_mark_id', 'id');
    }
}
