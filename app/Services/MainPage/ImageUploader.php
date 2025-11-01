<?php

namespace App\Services\MainPage;

use App\Models\LandingPage;
use Illuminate\Support\Facades\Log;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageUploader
{
    public function upload($request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            ]);

            $landingPage = LandingPage::firstOrCreate([]);

            $media = $landingPage->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->withCustomProperties(['optimized' => true])
                ->toMediaCollection('images');

            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($media->getPath());

            return redirect()->back()->with('message', 'Image uploaded');

        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw $e;
        }
    }
}