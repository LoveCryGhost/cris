<?php

namespace App\Http\Requests\User;



use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    public function rules()
    {

        $user = Auth::user();
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => [
                                'required',
                                Rule::unique('users'),
                            ],
                        'birthday' => 'date'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => [
                            'required',
                            Rule::unique('users')->ignore($user->id),
                            'regex:/^[A-Za-z0-9\-\_]+$/'
                        ],
                        'birthday' => 'date|nullable'
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
            'name.required' => '用戶名稱不能為空',
            'name.unique' => '用戶名稱不能重複',
            'name.regex' => '用戶名稱只能為英文字母 與 數字',
            'birthday.date' => '生日須為日期格式'
        ];
    }
}
