<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        return [
            'category_uuid' => 'uuid|id:categories',
            'is_publish'    => 'string|max:1',
            'product_name'  => 'string|min:3',
            'category_name' => 'string|min:3',
            'price_at' => 'int|numeric',
            'price_to' => 'int|numeric',
        ];
    }
}
