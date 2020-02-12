<?php

namespace App\Http\Controllers\User;



class UserController extends UserCoreController
{


    public function index(){
        return redirect()->back()
            ->with(['toast'=> [
                "heading" => "爬蟲任務-創建成功",
                "text" =>  '',
                "position" => "bottom-right",
                "loaderBg" => "#ff6849",
                "icon" => "info",
                "hideAfter" => 3000,
                "stack" => 6
            ] ]);
    }
}
