<?php

namespace App\Http\Controllers\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Member\MemberRequest;
use App\Models\Member;
use App\Services\Member\MemberService;


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


}
