<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeOffer extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'user_id', 'offer_details'];
}
