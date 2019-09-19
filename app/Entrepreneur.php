<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
//    use Notifiable;
    //
    protected $fillable = [
        'budget_spent', 'worker_email_af', 'rating_af', 'started_work', 'finished_work','email'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','email','email');
    }
}
