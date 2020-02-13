<?php

namespace App\Http\Controllers\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Member\MemberRequest;
use App\Models\Member;

class MembersController extends MemberCoreController
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }

    //Dashboard
    public function index(){
        return view(config('theme.member.view').'member.index', compact(''));
    }

    //顯示使用者資料
    public function edit(Member $member)
    {
        $this->authorize('update', $member);
        return view(config('theme.member.view').'member.show', compact('member'));
    }

    public function update(MemberRequest $request,  ImageUploadHandler $uploader,Member $member)
    {
        $this->authorize('update', $member);
        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $member->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $member->update($data);
        return redirect()->route('member.show',['member'=>$member->id])
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
