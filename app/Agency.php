<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $fillable = [
        'budget_spent_freelancer', 'worker_email_freelancer', 'rating_freelancer', 'started_work', 'finished_work','email'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','email','email');
    }
}
