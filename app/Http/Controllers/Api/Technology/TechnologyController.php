<?php

namespace App\Http\Controllers\Api\Technology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TechnologyField;
use App\Models\TechnologyFieldSkill;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    // --- Technology Fields API ---
    
    // GET /api/technology
    public function index()
    {
        $fields = TechnologyField::with('skills')->latest()->get();
        return response()->json(['success' => true, 'data' => $fields]);
    }

    // POST /api/technology
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'frame_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'tools_title'=>'nullable|string|max:255',
            'tools_description'=>'nullable|string',
            'is_active'=>'nullable|boolean',
        ]);

        $data = $request->only(['title','subtitle','description','tools_title','tools_description','is_active']);

        if($request->hasFile('image')) $data['image']=$request->file('image')->store('technology_fields','public');
        if($request->hasFile('frame_image')) $data['frame_image']=$request->file('frame_image')->store('technology_fields','public');

        $field = TechnologyField::create($data);

        return response()->json(['success' => true, 'message' => 'Technology Field added.', 'data' => $field]);
    }

    // GET /api/technology/{field}
    public function show(TechnologyField $field)
    {
        $field->load('skills');
        return response()->json(['success' => true, 'data' => $field]);
    }

    // PUT /api/technology/{field}
    public function update(Request $request, TechnologyField $field)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'frame_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'tools_title'=>'nullable|string|max:255',
            'tools_description'=>'nullable|string',
            'is_active'=>'nullable|boolean',
        ]);

        $data = $request->only(['title','subtitle','description','tools_title','tools_description','is_active']);

        if($request->hasFile('image')){
            if($field->image && Storage::disk('public')->exists($field->image)) Storage::disk('public')->delete($field->image);
            $data['image']=$request->file('image')->store('technology_fields','public');
        }

        if($request->hasFile('frame_image')){
            if($field->frame_image && Storage::disk('public')->exists($field->frame_image)) Storage::disk('public')->delete($field->frame_image);
            $data['frame_image']=$request->file('frame_image')->store('technology_fields','public');
        }

        $field->update($data);

        return response()->json(['success' => true, 'message' => 'Technology Field updated.', 'data' => $field]);
    }

    // DELETE /api/technology/{field}
    public function destroy(TechnologyField $field)
    {
        if($field->image && Storage::disk('public')->exists($field->image)) Storage::disk('public')->delete($field->image);
        if($field->frame_image && Storage::disk('public')->exists($field->frame_image)) Storage::disk('public')->delete($field->frame_image);
        $field->delete();

        return response()->json(['success' => true, 'message' => 'Technology Field deleted.']);
    }

    // --- Technology Skills API ---
    
    // POST /api/technology/{field}/skills
    public function storeSkill(Request $request, $fieldId)
    {
        $request->validate([
            'icon'=>'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'name'=>'nullable|string|max:255',
            'order_no'=>'nullable|integer',
            'is_active'=>'nullable|boolean',
        ]);

        $field = TechnologyField::findOrFail($fieldId);

        $iconPath = $request->file('icon')->store('technology_field_skills','public');

        $skill = $field->skills()->create([
            'icon'=>$iconPath,
            'name'=>$request->name,
            'order_no'=>$request->order_no ?? 0,
            'is_active'=>$request->is_active ?? 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Skill added.', 'data' => $skill]);
    }

    // DELETE /api/technology/{field}/skills/{skill}
    public function destroySkill($fieldId, TechnologyFieldSkill $skill)
    {
        if($skill->icon && Storage::disk('public')->exists($skill->icon)) Storage::disk('public')->delete($skill->icon);
        $skill->delete();

        return response()->json(['success' => true, 'message' => 'Skill deleted.']);
    }
}
