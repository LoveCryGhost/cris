<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;

class AdminsController extends AdminCoreController
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //Dashboard
    public function index(){
        return view(config('theme.admin.view').'admin.index', compact(''));
    }

    //顯示使用者資料
    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);
        return view(config('theme.admin.view').'admin.show', compact('admin'));
    }

    public function update(AdminRequest $request,  ImageUploadHandler $uploader,Admin $admin)
    {
        $this->authorize('update', $admin);
        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $admin->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $admin->update($data);
        return redirect()->route('admins.show',['admin'=>$admin->id])
            ->with('toast', [
                "heading" => "個人訊息 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


}
