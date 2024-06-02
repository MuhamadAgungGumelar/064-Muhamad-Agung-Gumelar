<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Shop;
use App\Models\Cart;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'price', 'image', 'shop_id', 'categories_id'
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
