<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DateTime;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'contact_no', 'address_1', 'address_2', 'city', 'country', 'postal_code','email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function role()
    {
        switch($this->role)
        {
            case 1:
                return 'admin';
                break;
            case 2:
                return 'manager';
                break;
            default:
                return 'customer';
        }
    }

    public function isAdmin()
    {
        if ($this->role == 1)
            return true;
        return false;
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function spending()
    {
        $spending = 0;
        foreach($this->reservations()->get() as $reservation)
        {
            $spending += $reservation->price;
        }
        return $spending;
    }

    public function dob()
    {
        return DateTime::createFromFormat('Y-m-d', $this->date_of_birth)->format('m/d/Y');
    }
}
