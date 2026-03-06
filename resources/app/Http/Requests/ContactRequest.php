<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "firstname" =>"required|string|max:15",
            "lastname" =>"required|string|max:15",
            "email"=> "required|string|max:300|email:dns",
            "subject"=> "nullable|string|max:50",
            "message"=> "nullable|string|max:255",
        ];
    }
}
