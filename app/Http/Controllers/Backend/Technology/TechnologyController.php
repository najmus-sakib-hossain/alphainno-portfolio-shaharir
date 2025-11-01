<?php

namespace App\Http\Controllers\Backend\Technology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TechnologyField;
use App\Models\TechnologyFieldSkill;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    // --- Technology Fields CRUD ---
    public function index()
    {
        $fields = TechnologyField::latest()->get();
        return view('pages.technology.index', compact('fields'));
    }

    public function createField()
    {
        return view('pages.technology.create_field');
    }

    public function storeField(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'frame_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
            'tools_title'=>'nullable|string|max:255',
            'tools_description'=>'nullable|string',
            'is_active'=>'nullable|boolean',
        ]);

        $data = $request->only(['title','subtitle','description','tools_title','tools_description','is_active']);

        if($request->hasFile('image')) $data['image']=$request->file('image')->store('technology_fields','public');
        if($request->hasFile('frame_image')) $data['frame_image']=$request->file('frame_image')->store('technology_fields','public');

        TechnologyField::create($data);

        return redirect()->route('technology.index')->with('success','Technology Field added.');
    }

    public function editField(TechnologyField $field)
    {
        return view('pages.technology.edit_field', compact('field'));
    }

    public function updateField(Request $request, TechnologyField $field)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
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

        return redirect()->route('technology.index')->with('success','Technology Field updated.');
    }

    public function destroyField(TechnologyField $field)
    {
        if($field->image && Storage::disk('public')->exists($field->image)) Storage::disk('public')->delete($field->image);
        if($field->frame_image && Storage::disk('public')->exists($field->frame_image)) Storage::disk('public')->delete($field->frame_image);
        $field->delete();
        return redirect()->route('technology.index')->with('success','Technology Field deleted.');
    }

    // --- Skills CRUD ---
    public function createSkill($fieldId)
    {
        $field=TechnologyField::findOrFail($fieldId);
        return view('pages.technology.create_skill', compact('field'));
    }

    public function storeSkill(Request $request, $fieldId)
    {
        $request->validate([
            'icon'=>'required|image|mimes:jpg,jpeg,png,svg,webp|max:5048',
            'name'=>'nullable|string|max:255',
            'order_no'=>'nullable|integer',
        ]);

        $field=TechnologyField::findOrFail($fieldId);

        $iconPath=$request->file('icon')->store('technology_field_skills','public');

        $field->skills()->create([
            'icon'=>$iconPath,
            'name'=>$request->name,
            'order_no'=>$request->order_no ?? 0,
            'is_active'=>1,
        ]);

        return redirect()->route('technology.editField', $fieldId)->with('success','Skill added.');
    }

    public function destroySkill($fieldId, TechnologyFieldSkill $skill)
    {
        if($skill->icon && Storage::disk('public')->exists($skill->icon)) Storage::disk('public')->delete($skill->icon);
        $skill->delete();
        return redirect()->route('technology.editField', $fieldId)->with('success','Skill deleted.');
    }
}
