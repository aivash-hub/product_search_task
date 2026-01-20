<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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
            'q' => ['nullable', 'string', 'max:255'],

            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to'   => ['nullable', 'numeric', 'min:0'],

            'category_id' => ['nullable', 'integer', 'exists:categories,id'],

            'in_stock' => ['nullable', 'boolean'],

            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],

            'sort' => ['nullable', 'in:price_asc,price_desc,rating_desc,newest'],

            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }
}
