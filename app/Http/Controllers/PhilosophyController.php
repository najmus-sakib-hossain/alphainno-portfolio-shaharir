<?php

namespace App\Http\Controllers;

use App\Models\Philosophy;
use Illuminate\Http\Request;

class PhilosophyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $philosophies = Philosophy::latest()->get();

        return view('pages.philosophy.index', compact('philosophies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.philosophy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'logic_theory' => 'required|string|max:255',
                'logics' => 'required|array|min:1',
                'logics.*' => 'required|string|max:500',
            ]);
    
            Philosophy::create([
                'logic_theory' => $request->logic_theory,
                'logics' => $request->logics,
            ]);
    
            return redirect()->route('philosophies.index')
                             ->with('success', 'Philosophical logic added successfully!');
        }
    
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
    public function edit(Philosophy $philosophy)
    {
        return view('pages.philosophy.edit', compact('philosophy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'logic_theory' => 'required|string|max:255',
            'logics' => 'required|array|min:1',
            'logics.*' => 'required|string|max:500',
        ]);

        $phylosophi = Philosophy::findOrFail($id);
        $phylosophi->update([
            'logic_theory' => $request->logic_theory,
            'logics' => $request->logics,
        ]);

        return redirect()->route('philosophies.index')
                         ->with('success', 'Philosophical logic updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $phylosophi = Philosophy::findOrFail($id);
        $phylosophi->delete();

        return true;
    }
}
