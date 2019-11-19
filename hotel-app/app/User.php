<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Customer;
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
    ];
    protected $guarded = [];
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
    ];
    public function customer(){
        return $this->hasOne(Customer::class);
    }
    /*protected static function boot(){
        parent::boot();
        static::created( function($user){
            $user->customer()->create([
                'first_name' => $user->name,
                'first_name' => 'test last',
                //'customer_id' => $user->id
            ]);
        });
    }*/
    public function isAdmin(){
        return intval($this->id) === 1;
    }
}
