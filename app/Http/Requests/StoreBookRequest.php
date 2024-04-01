<?php

namespace App\Http\Requests;

use App\Rules\ISBN;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'cover' => 'required|image|mimes:jpg,jpeg,png',
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' =>  ['required', new ISBN],
            'edition' => 'required|string',
            'publisher' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'category' => 'required|string',
            'language' => 'required|string',
            'description' => 'required|string:max:1000',
        ];
    }
}
