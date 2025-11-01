<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::latest()->paginate(10);
        return view('pages.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quote_text' => 'required|string',
        ]);

        Quote::create([
            'quote_text' => $request->quote_text,
        ]);

        return redirect()->route('quotes.index')->with('success', 'Quote added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        return view('pages.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'quote_text' => 'required|string',
        ]);

        $quote->update([
            'quote_text' => $request->quote_text,
        ]);

        return redirect()->route('quotes.index')->with('success', 'Quote updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        // Delete the quote
        $quote->delete();

        // Redirect back with success message
        return redirect()
            ->route('quotes.index')
            ->with('success', 'Quote deleted successfully!');
    }
}
