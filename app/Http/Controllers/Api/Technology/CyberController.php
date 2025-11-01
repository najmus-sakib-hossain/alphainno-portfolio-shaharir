<?php

namespace App\Http\Controllers\Api\Technology;

use App\Http\Controllers\Controller;
use App\Models\Cyber;
use Illuminate\Http\Request;

class CyberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cyber = Cyber::latest()->first();

        return response()->json([
            'status' => 'success',
            'data' => $cyber
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
