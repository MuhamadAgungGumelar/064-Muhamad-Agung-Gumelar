<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use app\Models\User;
use app\Models\Item;

class Shop extends Model
{
    use HasFactory;

    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
