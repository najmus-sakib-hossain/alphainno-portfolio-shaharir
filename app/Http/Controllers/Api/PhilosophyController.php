<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Philosophy;
use Illuminate\Http\Request;

class PhilosophyController extends Controller
{
    public function index()
    {
        $philosophy = Philosophy::latest()->first();

        return response()->json([
            'status' => 'success',
            'data' => $philosophy,
        ]);
    }
}
