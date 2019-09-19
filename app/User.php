<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use JamesMills\LaravelAdmin\Models\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'activity', 'sector', 'city', 'customer_type',
        'street','pricing','pricing2','pricing3','currency'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'sector' => 'array',
        'pricing' => 'array',
        'pricing2' => 'array',
        'pricing3' => 'array',
    ];
    public function smmservices()
    {
        return $this->hasMany('App\SMMService','email','email');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser','email','email');
    }
    public function sectors_unique()
    {
        return $this->hasMany('App\Sector','email','email');
    }

    public function businessMarks()
    {
        return $this->hasMany('App\BusinessMark','email','email');
    }

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';
    public function isAdmin()    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
//        lazim dayl
    }
}
