<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Impact;
use App\Models\ImpactPoint;


class ImpactController extends Controller
{
    public function index()
    {
        $impacts = Impact::with('points')->orderBy('order_no')->get();
        return view('pages.impacts.index', compact('impacts'));
    }

    public function create()
    {
        return view('pages.impacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:entrepreneur,technology',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'image4' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'points.*' => 'required|string|max:255',
        ]);

        $data = $request->except(['image1','image2','image3','image4','points']);

        foreach (['image1','image2','image3','image4'] as $img) {
            if ($request->hasFile($img)) {
                $data[$img.'_path'] = $request->file($img)->store('impacts', 'public');
            }
        }

        $impact = Impact::create($data);

        if ($request->points) {
            foreach ($request->points as $index => $point) {
                ImpactPoint::create([
                    'impact_id' => $impact->id,
                    'point' => $point,
                    'order_no' => $index + 1,
                ]);
            }
        }

        return redirect()->route('impacts.index')->with('success','Impact section created successfully.');
    }

    public function show(Impact $impact)
    {
        return view('pages.impacts.show', compact('impact'));
    }

    public function edit(Impact $impact)
    {
        return view('pages.impacts.edit', compact('impact'));
    }

    public function update(Request $request, Impact $impact)
    {
        $request->validate([
            'type' => 'required|in:entrepreneur,technology',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'points.*' => 'required|string|max:255',
        ]);

        $data = $request->except(['image1','image2','image3','image4','points']);

        foreach (['image1','image2','image3','image4'] as $img) {
            if ($request->hasFile($img)) {
                if ($impact->{$img.'_path'} && Storage::disk('public')->exists($impact->{$img.'_path'})) {
                    Storage::disk('public')->delete($impact->{$img.'_path'});
                }
                $data[$img.'_path'] = $request->file($img)->store('impacts', 'public');
            }
        }

        $impact->update($data);

        if ($request->points) {
            $impact->points()->delete();
            foreach ($request->points as $index => $point) {
                ImpactPoint::create([
                    'impact_id' => $impact->id,
                    'point' => $point,
                    'order_no' => $index + 1,
                ]);
            }
        }

        return redirect()->route('impacts.index')->with('success','Impact section updated successfully.');
    }

    public function destroy(Impact $impact)
    {
        foreach (['image1_path','image2_path','image3_path','image4_path'] as $img) {
            if ($impact->{$img} && Storage::disk('public')->exists($impact->{$img})) {
                Storage::disk('public')->delete($impact->{$img});
            }
        }

        $impact->delete();

        return redirect()->route('impacts.index')->with('success','Impact section deleted successfully.');
    }
}
