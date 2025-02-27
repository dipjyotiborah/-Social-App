<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeOffer; // Ensure this model exists
use Illuminate\Support\Facades\Log;

class ExchangeController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Exchange Offer Request:', $request->all());

        // Validate input
        $validatedData = $request->validate([
            'item_id' => 'required|integer|exists:items,id',
            'user_id' => 'required|integer|exists:users,id',
            'offer_details' => 'nullable|string',
        ]);

        // Store exchange offer in the database
        $offer = ExchangeOffer::create($validatedData);

        return response()->json([
            'message' => 'Offer received successfully!',
            'offer' => $offer
        ], 200);
    }
}
