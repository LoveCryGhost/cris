<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SupplierGroupRequest extends Request
{
    public function rules()
    {
        $supplierGroup=$this->route('supplierGroup');

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'sg_name' => ['required', 'min:2', Rule::unique('supplier_groups')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'sg_name' => ['required', 'min:2', Rule::unique('supplier_groups')->ignore($supplierGroup->sg_id,'sg_id')],
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

            'sg_name.min' => '產品類型名稱不能少於2個字元',
            'sg_name.required' => '產品類型不能為空',
            'sg_name.unique' => '產品類型不能重複',
        ];
    }
}
