<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TypeRequest extends Request
{
    public function rules()
    {
        $type=$this->route('type');

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        't_name' => ['required'],
                        Rule::unique('types'),
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        't_name' => ['required', Rule::unique('types')->ignore($type->t_id,'t_id')],
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
            't_name.required' => '產品類型不能為空',
            't_name.unique' => '產品類型不能重複',
        ];
    }
}
