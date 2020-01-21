<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DOANVIEN_THANHNIEN_ID', 'email', 'password','VAITRO_ID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'REMEMBER_TOKEN',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function doanvien_thanhnien()
    {
        return $this->belongsTo('App\doanvien_thanhnien', 'DOANVIEN_THANHNIEN_ID', 'ID');
    }

    public function vaitro()
    {
        return $this->belongsTo('App\vaitro', 'VAITRO_ID', 'ID');
    }

}
