<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Admin;
use App\Models\Company;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    use HasFactory, Notifiable, HasApiTokens;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function admin(){

        return $this->hasOne(Admin::class,'user_id','admin_id');
    }

    public function company(){

        return $this->hasOne('App\Models\Company','user_id');
    }

    public function guest(){

        return $this->hasOne(Guest::class,'user_id','guest_id');
    }
}
