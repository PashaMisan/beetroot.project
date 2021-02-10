<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        //TODO Настроить корректное отображение ошибок
        return [
            'name' => ['required', 'max:200', 'string'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'description' => ['required', 'max:500', 'string'],
            'text' => ['required', 'max:2000', 'string'],
            'image' => ['sometimes', 'nullable', 'file', 'mimes:jpg,jpeg,bmp,png', 'max:2000'],
            'weight' => ['required', 'numeric'],
            'price' => ['required', 'numeric']
        ];
    }
}
