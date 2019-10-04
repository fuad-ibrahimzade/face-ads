<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMMService extends Model
{
    //
    protected $fillable = [
        'pricing', 'services_for_price','email','work_start','work_end','business_mark_id','business_mark_name'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','email','email');
    }
    public function businessMark()
    {
        return $this->belongsTo('App\BusinessMark', 'business_mark_id', 'id');
    }
}
