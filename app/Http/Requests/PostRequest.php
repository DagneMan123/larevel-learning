<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'body'      => 'required|string',
            'author'    => 'nullable|string|max:100',
            'published' => 'boolean',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A post must have a title.',
            'body.required'  => 'Post body cannot be empty.',
        ];
    }
}
