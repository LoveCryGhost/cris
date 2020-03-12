<?php

namespace App\Http\Requests\Staff;



use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StaffRequest extends Request
{
    public function rules()
    {

        $staff = $this->staff;
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => [
                                'required',
                                Rule::unique('staffs'),
                            ],
                        'birthday' => 'date',
                        'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',

                        'email' =>'email',
                        'social_security_at' => 'date',
                        'join_at' => 'date',
                        'apply_for_leave_at' => 'date',
                        'leave_at' => 'date',

                        'education1_from' => 'date',
                        'education1_to' => 'date',
                        'education2_from' => 'date',
                        'education2_to' => 'date',

                        'experience1_from' => 'date',
                        'experience1_to' => 'date',
                        'salary1' => 'integer',

                        'experience2_from' => 'date',
                        'experience2_to' => 'date',
                        'salary2' => 'integer',

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => [
                            'required',
                            Rule::unique('staffs')->ignore($staff->id),
                            'regex:/^[A-Za-z0-9\-\_]+$/'
                        ],
                        'birthday' => 'date|nullable',
                        'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',

                        'email' =>'email',
                        'social_security_at' => 'date',
                        'join_at' => 'date',
                        'apply_for_leave_at' => 'date',
                        'leave_at' => 'date',

                        'education1_from' => 'date',
                        'education1_to' => 'date',
                        'education2_from' => 'date',
                        'education2_to' => 'date',

                        'experience1_from' => 'date',
                        'experience1_to' => 'date',
                        'salary1' => 'integer',

                        'experience2_from' => 'date',
                        'experience2_to' => 'date',
                        'salary2' => 'integer',
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
            'birthday.date' => '生日須為日期格式',
            'avatar.mimes' =>'頭像必須是 jpeg, bmp, png, gif 的圖片格式',
            'avatar.dimensions' => '圖片清晰度不夠，長寬必須達到 208px 以上',
        ];
    }
}
