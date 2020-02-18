<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{
    public function rules()
    {
        $product=$this->route('product');
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'p_name' => ['required', 'min:2', Rule::unique('products')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'p_name' => ['required', 'min:2', Rule::unique('products')->ignore($product->p_id,'p_id')],
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [

            'p_name.min' => '產品類型名稱不能少於2個字元',
            'p_name.required' => '產品類型不能為空',
            'p_name.unique' => '產品類型不能重複',
        ];
    }
}
