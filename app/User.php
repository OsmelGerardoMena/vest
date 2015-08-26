<?php

namespace Vest;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 
            'email',
            'password',
            'identifier',
            'mobile',
            'phone',
            'address',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

   public function setPasswordAttribute($value){
        //al crear nuevo usuario, se le palica un hash a la contraseña
        if(!empty($value)){
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    ///** relacion de muchos a uno (relacion inversa) **///
    public function type()
    {
        //retorna un solo objeto type, ya que el usuario solo tiene un tipo
        return $this->belongsTo('Vest\Tables\UserTypes');
    }

    public function status()
    {
        //retorna un solo objeto type, ya que el usuario solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }
}
