<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use app\Models\Shop;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'price', 'shop_id', 'categories_id'
    ];

    public function shops(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function categories(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
