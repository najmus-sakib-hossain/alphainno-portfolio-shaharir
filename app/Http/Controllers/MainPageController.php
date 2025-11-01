<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainPage;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\MainPageRequest;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.home.main-page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainPageRequest $request)
    {
        $data = $request->validated();
        $mainPage = MainPage::create([
            'banner_text'   => $data['banner_text'],
            'moto'          => $data['moto'],
            'experience'    => $data['experience'],
            'projects'      => $data['projects'],
            'certification' => $data['certification'],
            'article'       => $data['article'],
            'books'         => $data['books'],
            'mentoring'     => $data['mentoring'],
        ]);

        if ($request->hasFile('banner_image')) {
            $mainPage->addMediaFromRequest('banner_image')
                     ->toMediaCollection('banner_images');
        }

        Cache::forget('main-page-data');
    
        return redirect()->back()->with('success', 'Main page information saved successfully!');
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
    public function edit(string $id)
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
