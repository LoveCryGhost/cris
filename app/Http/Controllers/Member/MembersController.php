<?php

namespace App\Http\Controllers\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Member\MemberRequest;
use App\Models\Member;
use App\Rules\CurrentPasswordRule;
use App\Services\Member\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class MembersController extends MemberCoreController
{

    protected $memberService;
    public function __construct(MemberService $memberService)
    {
        $this->middleware('auth:member');
        $this->memberService = $memberService;
    }

    //Dashboard
    public function index(){
        return view(config('theme.member.view').'member.index', compact(''));
    }

    public function edit(Member $member)
    {
        $this->authorize('update', $member);
        return view(config('theme.member.view').'member.edit', compact('member'));
    }



    public function update(MemberRequest $request, Member $member, ImageUploadHandler $uploader)
    {
        $this->authorize('update', $member);

        //取得參數
        $data = $request->all();

        $data = $this->memberService->save_avatar($data, $member, $request, $uploader);

        $member->update($data);

        return redirect()->route('member.edit',['member'=>$member->id])
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

    //更新密碼
    public function update_password(Request $request, Member $member)
    {
        $this->authorize('update', $member);

        //驗證
        $this->validate($request, [
            'old_password' => ['required', new CurrentPasswordRule()],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'old_password.required' => '舊密碼不能為空',
            'old_password.same' => '舊密碼輸入錯誤',
            'new_password.required' => '新密碼不能為空 且 最少為8位數字',
            'new_password.min' => '新密碼不能為空 且 最少為8位數字',
            'new_password.confirmed' => '密碼必須一致',
        ]);

        $data = $request->all();
        $data = $this->memberService->save_change_password($data, $member, $request);

        $member->update($data);
        return redirect()->route('member.edit', ['member'=> $member->id])
            ->with('toast', [
                "heading" => "Member 密碼 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


}
