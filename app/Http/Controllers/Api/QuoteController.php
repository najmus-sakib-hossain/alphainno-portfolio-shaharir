<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index()
    {
        $quote = Quote::latest()->first();
        return response()->json([
            'status' => 'success',
            'data' => $quote,
        ]);
    }
}
