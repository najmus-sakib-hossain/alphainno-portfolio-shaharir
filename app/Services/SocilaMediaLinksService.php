<?php

namespace App\Services;

use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SocilaMediaLinksService
{
    public function store($request)
    {
        // 1. Map platform names to their corresponding input field names from the HTML form.
        // NOTE: The HTML input fields MUST have the 'name' attribute matching the values in this array 
        // (e.g., <input name="twitter-url" ...>).
        $platformMap = [
            'twitter' => 'twitter-url',
            'facebook' => 'facebook-url',
            'instagram' => 'instagram-url',
            'pinterest' => 'pinterest-url',
            'dribbble' => 'dribbble-url',
            'behance' => 'behance-url',
            'linkedin' => 'linkedin-url',
            'youtube' => 'youtube-url',
        ];

        // 2. Setup validation rules: all fields are optional, but if present, must be valid URLs.
        $validationRules = [];
        foreach ($platformMap as $inputName) {
            $validationRules[$inputName] = 'nullable|url|max:255';
        }

        try {
            // Note: validate() only returns fields that were present in the request and passed validation.
            $validatedData = $request->validate($validationRules);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 3. Use a database transaction for safe execution.
        DB::beginTransaction();

        try {
            foreach ($platformMap as $platformName => $inputName) {
                // Use the null coalescing operator to safely access the key.
                // This value will be null if the 'name' attribute is missing from the HTML form.
                $url = $validatedData[$inputName] ?? null;
                
                // DEBUGGING LOG: Show the platform and the value received.
                Log::debug("SOCIAL_LINK_PROCESS: Platform=" . $platformName . ", URL Received=" . (is_string($url) ? $url : 'null/empty'));


                if (!empty($url)) {
                    // Link provided: use updateOrCreate to create or replace the exact platform URL.
                    SocialLinks::updateOrCreate(
                        ['platform' => $platformName],
                        ['url' => $url]
                    );
                    
                    // DEBUGGING LOG: Confirmation of saving
                    Log::debug("SOCIAL_LINK_PROCESS: SAVED/UPDATED Link for Platform=" . $platformName);

                } else {
                    // DEBUGGING LOG: Confirmation of ignoring
                    Log::debug("SOCIAL_LINK_PROCESS: IGNORED Link (empty URL) for Platform=" . $platformName);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Social links updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging purposes
            Log::error("Failed to update social links: " . $e->getMessage());
            
            return redirect()->back()->with('error', 'An error occurred while saving links. Please try again.');
        }
    }
}
