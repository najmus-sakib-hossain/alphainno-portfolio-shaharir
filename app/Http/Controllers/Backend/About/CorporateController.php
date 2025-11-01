<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Corporate;

class CorporateController extends Controller
{
   public function index()
    {
        $corporates = Corporate::orderBy('order_no')->get();
        return view('pages.corporates.index', compact('corporates'));
    }

    public function create()
    {
        return view('pages.corporates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position_years' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:5048',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if($request->hasFile('image_path')){
            $data['image_path'] = $request->file('image_path')->store('corporates', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        Corporate::create($data);

        return redirect()->route('corporates.index')->with('success', 'Corporate Step created successfully.');
    }

    public function show(Corporate $corporate)
    {
        return view('pages.corporates.show', compact('corporate'));
    }

    public function edit(Corporate $corporate)
    {
        return view('pages.corporates.edit', compact('corporate'));
    }

    public function update(Request $request, Corporate $corporate)
    {
        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position_years' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if($request->hasFile('image_path')){
            $data['image_path'] = $request->file('image_path')->store('corporates', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $corporate->update($data);

        return redirect()->route('corporates.index')->with('success', 'Corporate Step updated successfully.');
    }

    public function destroy(Corporate $corporate)
    {
        $corporate->delete();
        return redirect()->route('corporates.index')->with('success', 'Corporate Step deleted successfully.');
    }
}