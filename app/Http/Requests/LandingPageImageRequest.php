<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingPageImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Main image rules
        $mainImageRules = [
            'main_image' => 'required|image|max:5120', // required, max 5MB
        ];

        // Side images rules (image1..image10)
        $sideImageRules = [];
        for ($i = 1; $i <= 10; $i++) {
            $sideImageRules["image{$i}"] = 'nullable|image|max:5120';
        }

        // Other fields
        $otherRules = [
            'url' => 'required|string|max:255',
        ];

        return array_merge($otherRules, $mainImageRules, $sideImageRules);
    }

    public function messages(): array
    {
        $messages = [
            'main_image.required' => 'Please upload a main image.',
            'main_image.image' => 'Main image must be a valid image file.',
            'main_image.max' => 'Main image must not exceed 5MB.',
            'url.required' => 'URL is required.',
            'url.max' => 'URL cannot be longer than 255 characters.',
        ];

        // Custom messages for side images
        for ($i = 1; $i <= 10; $i++) {
            $messages["image{$i}.image"] = "Image {$i} must be a valid image file.";
            $messages["image{$i}.max"] = "Image {$i} must not exceed 5MB.";
        }

        return $messages;
    }
}
