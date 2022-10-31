<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCanvasImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'title' => 'required|string|max:255',
            'description' => ['sometimes', 'nullable', 'max:1000'],
            'width' => 'required|int|max:1000',
            'height' => 'required|int|max:1000',
        ];
    }
}
