<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class Product_SKURequest extends Request
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
                        'price' => ['integer'],
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'price' => ['integer'],
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

            'price.integer' => '售價必須為數字',
        ];
    }
}
