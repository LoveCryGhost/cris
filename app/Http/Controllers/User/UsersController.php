<?php

namespace App\Http\Controllers\User;



use App\Models\User;

class UsersController extends UserCoreController
{


    //顯示UserIndex
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

    //顯示使用者資料
    public function show(User $user)
    {
        return view(config('theme.user.view').'user.show', compact('user'));
    }
}
