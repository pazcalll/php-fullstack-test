<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyClientRequest extends FormRequest
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
            //
            "name" => ["required", "max:250"],
            "is_project" => ["required", "string", "max:30"],
            "self_capture" => ["required", "string", "in:0,1"],
            "client_prefix" => ["required", "string", "max:4"],
            "client_logo" => ["required", "string", "max:255"],
            "address" => ["nullable", "string", "max:255"],
            "phone_number" => ["nullable", "string", "max:50"],
            "city" => ["nullable", "string", "max:50"],
        ];
    }
}
