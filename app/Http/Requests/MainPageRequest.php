<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainPageRequest extends FormRequest
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
        return [
            'banner_text'   => ['required', 'string', 'max:1000'],
            'moto'          => ['required', 'string', 'max:255'],
            'experience'    => ['required', 'integer', 'min:0'],
            'projects'      => ['required', 'integer', 'min:0'],
            'certification' => ['required', 'integer', 'min:0'],
            'article'       => ['required', 'integer', 'min:0'],
            'books'         => ['required', 'integer', 'min:0'],
            'mentoring'     => ['required', 'integer', 'min:0'],
            'banner_image'  => ['nullable', 'image', 'max:5048'],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'banner_text.required'   => 'Please enter a banner text.',
            'moto.required'          => 'Please enter your motto.',
            'experience.required'    => 'Experience field is required.',
            'projects.required'      => 'Please specify number of projects.',
            'certification.required' => 'Please enter number of certifications.',
            'article.required'       => 'Please enter number of articles.',
            'books.required'         => 'Please enter number of books.',
            'mentoring.required'     => 'Please enter number of mentoring sessions.',
        ];
    }
}
