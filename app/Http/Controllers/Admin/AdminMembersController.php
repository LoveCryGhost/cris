<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminMemberRequest;
use App\Models\Member;

class AdminMembersController extends AdminCoreController
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //Dashboard
    public function index(){
        $members = Member::paginate(5);
        return view(config('theme.admin.view').'member.index', compact('members'));
    }

    public function edit(Member $member){
        return view(config('theme.admin.view').'member.edit', compact('member'));
    }

    public function update(AdminMemberRequest $request , ImageUploadHandler $uploader, Member $member){
        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $member->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $member->update($data);
        return redirect()->route('admin.member.index')
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


    public function create(){
        return view(config('theme.admin.view').'member.create', compact(''));
    }

//    //顯示使用者資料
//    public function edit(Admin $admin)
//    {
//        $this->authorize('update', $admin);
//        return view(config('theme.admin.view').'admin.edit', compact('admin'));
//    }
//
//    public function update(AdminRequest $request,  ImageUploadHandler $uploader,Admin $admin)
//    {
//        $this->authorize('update', $admin);
//        $data = $request->all();
//        if($request->avatar) {
//            $result = $uploader->save($request->avatar, 'avatars', $admin->id, 416);
//            if ($result) {
//                $data['avatar'] = $result['path'];
//            }
//        }
//        $admin->update($data);
//        return redirect()->route('admin.edit',['admin'=>$admin->id])
//            ->with('toast', [
//                "heading" => "個人訊息 - 更新成功",
//                "text" =>  '',
//                "position" => "top-right",
//                "loaderBg" => "#ff6849",
//                "icon" => "success",
//                "hideAfter" => 3000,
//                "stack" => 6
//            ]);
//    }


}
