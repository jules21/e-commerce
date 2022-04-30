<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'currency', 'amount', 'account_number'];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function topups()
    {
        return $this->hasMany(Topup::class);
    }
}
