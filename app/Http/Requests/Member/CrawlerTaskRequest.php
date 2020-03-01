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

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'url' => ['required'],
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

            'url.required' => '任務名稱不能為空',
        ];
    }
}
