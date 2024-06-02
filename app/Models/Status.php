<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Cart;
use App\Models\Transaction;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
