<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_as' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * User has a cart associated with them
     * 
     * @return illuminate\Database\Eloquent\Relations\HasOne;
     */
    public function cart()  : HasOne
    {
        return $this->hasOne(Transaction::class, 'user_id')->whereStatus('cart');
    }

    /**
     * User has addresses associated with them
     * 
     * @return illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function addresses()  : HasMany
    {
        return $this->hasMany(Address::class, 'user_id')
            ->select('addresses.*', 'provinces.name as province')
            ->join('provinces', 'provinces.id', 'addresses.province_id');
    }
}
