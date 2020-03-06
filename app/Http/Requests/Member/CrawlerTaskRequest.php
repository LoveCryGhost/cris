<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CrawlerTaskRequest extends Request
{
    public function rules()
    {
        $type=$this->crawlertask;

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'url' => ['required'],
                        'ct_name' => ['required'],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'ct_name' => ['required'],
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
            'url.required' => '網址不能為空',
            'ct_name.required' => '任務不能為空',
        ];
    }
}
