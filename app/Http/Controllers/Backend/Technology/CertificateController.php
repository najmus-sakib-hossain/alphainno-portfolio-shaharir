<?php

namespace App\Http\Controllers\Backend\Technology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
     public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('pages.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('pages.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')->store('certificates', 'public');

        Certificate::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('pages.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'description', 'is_active');

        if ($request->hasFile('image')) {
            // delete old image
            if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
                Storage::disk('public')->delete($certificate->image);
            }
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
