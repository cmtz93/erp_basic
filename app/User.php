<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Concerns\Filterable;
use App\Http\Concerns\Statusable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Filterable, Statusable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'email', 
        'password', 
        'username', 
        'status',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'updated_at',
        'deleted_at'
    ];


    protected $dates = [
        'deleted_at'
    ];

    protected $appends = [
        'fullname',
    ];


    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
