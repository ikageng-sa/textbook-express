<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'amount',
        'session',
    ];

    /**
     * Transaction record has items associated with it
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public  function items() : HasMany
    {
        return  $this->hasMany(Order::class, 'transaction_id');
    }
}
