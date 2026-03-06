<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:10000'],
            'projectname' => ['required', 'string', 'max:255'],
            'clientname' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'description' => ['nullable', 'string', 'max:5000'],
            'category' => ['nullable', 'string', 'max:30'],
            'location' => ['nullable', 'string', 'max:80'],
            'startdate' => ['nullable', 'date_format:Y-m-d'],
            'completeddate' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'projectname.required' => 'The project name is required.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The status must be Active or Inactive.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a JPEG, PNG, JPG, GIF, or WebP.',
            'image.max' => 'The image must not exceed 9MB.',
            'startdate.date_format' => 'The start date must be in DD-MM-YYYY format.',
            'completeddate.date_format' => 'The completed date must be in DD-MM-YYYY format.',
            'description.max' => 'The description must not exceed 5000 characters.',
            'category.max' => 'The category must not exceed 30 characters.',
            'location.max' => 'The location must not exceed 80 characters.'
        ];
    }
}


