<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::latest()->get();
        return view('pages.travels.index', compact('travels'));
    }

    public function create()
    {
        return view('pages.travels.create');
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'country_name' => 'required|string|max:255',
    //         'country_flag_path' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5048',
    //         'map_image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:5096',
    //         'order_no' => 'nullable|integer',
    //         'is_active' => 'nullable|boolean',
    //     ]);

    //     if($request->hasFile('country_flag_path')){
    //         $data['country_flag_path'] = $request->file('country_flag_path')->store('travels', 'public');
    //     }
    //     if($request->hasFile('map_image_path')){
    //         $data['map_image_path'] = $request->file('map_image_path')->store('travels', 'public');
    //     }

    //     $data['is_active'] = $request->has('is_active') ? 1 : 0;

    //     Travel::create($data);

    //     return redirect()->route('travels.index')->with('success', 'Travel country added successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'map_image' => 'required|image|max:2048',
            'countries.*.name' => 'required|string|max:255',
            'countries.*.flag' => 'required|image|max:2048',
        ]);

        // Store basic data
        $innovation = Travel::create([
            'title' => $request->title,
            'content' => $request->content,
            'countries' => collect($request->countries)->map(fn($c) => $c['name'])->toArray(),
        ]);

        // Store map image
        if ($request->hasFile('map_image')) {
            $innovation->addMediaFromRequest('map_image')->toMediaCollection('map_image');
        }

        // Store country flags
        if ($request->has('countries')) {
            foreach ($request->countries as $country) {
                if (isset($country['flag'])) {
                    $innovation->addMedia($country['flag'])->toMediaCollection('country_flags');
                }
            }
        }

        return redirect()->route('travels.index')->with('success', 'Travel map created successfully!');
    }

    public function show(Travel $travel)
    {
        return view('pages.travels.show', compact('travel'));
    }

    public function edit(Travel $travel)
    {
        return view('pages.travels.edit', compact('travel'));
    }

    // public function update(Request $request, Travel $travel)
    // {
    //     $data = $request->validate([
    //         'country_name' => 'required|string|max:255',
    //         'country_flag_path' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5048',
    //         'map_image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:5096',
    //         'order_no' => 'nullable|integer',
    //         'is_active' => 'nullable|boolean',
    //     ]);

    //     if($request->hasFile('country_flag_path')){
    //         $data['country_flag_path'] = $request->file('country_flag_path')->store('travels', 'public');
    //     }
    //     if($request->hasFile('map_image_path')){
    //         $data['map_image_path'] = $request->file('map_image_path')->store('travels', 'public');
    //     }

    //     $data['is_active'] = $request->has('is_active') ? 1 : 0;

    //     $travel->update($data);

    //     return redirect()->route('travels.index')->with('success', 'Travel country updated successfully.');
    // }

    public function update(Request $request, Travel $travel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'map_image' => 'nullable|image|max:2048',
            'countries.*.name' => 'required|string|max:255',
            'countries.*.flag' => 'nullable|image|max:2048',
        ]);

        // Update title, content, countries
        $travel->update([
            'title' => $request->title,
            'content' => $request->content,
            'countries' => collect($request->countries)->map(fn($c) => $c['name'])->toArray(),
        ]);

        // Update map image if uploaded
        if ($request->hasFile('map_image')) {
            $travel->clearMediaCollection('map_image');
            $travel->addMediaFromRequest('map_image')->toMediaCollection('map_image');
        }

        // Update country flags
        if ($request->has('countries')) {
            foreach ($request->countries as $index => $country) {
                if (isset($country['flag'])) {
                    $existingFlag = $travel->getMedia('country_flags')[$index] ?? null;
                    if ($existingFlag) {
                        $existingFlag->delete();
                    }
                    $travel->addMedia($country['flag'])->toMediaCollection('country_flags');
                }
            }
        }

        return redirect()->route('travels.index')->with('success', 'Travel updated successfully!');
    }

    public function destroy(Travel $travel)
    {
        // Delete all media associated with this travel
        $travel->clearMediaCollection('map_image');
        $travel->clearMediaCollection('country_flags');

        // Delete the record from the database
        $travel->delete();

        return true;
    }

}
