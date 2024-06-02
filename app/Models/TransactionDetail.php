<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Transaction;

class TransactionDetail extends Model
{
    use HasFactory;

    public function Transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
