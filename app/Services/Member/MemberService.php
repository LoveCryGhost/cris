<?php

namespace App\Services\Member;

use App\Repositories\Member\MemberRepository;
use Illuminate\Support\Facades\Hash;

class MemberService extends MemberCoreService
{
    protected $memberRepo;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepo = $memberRepository;
    }

    public function all(){
    }

    //儲存Member照片
    public function save_avatar($data, $member, $request, $uploader){
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $member->id, 416);
            if ($result) {
                $data['avatar']=$result['path'];
            }
        }
        return $data;
    }

    //儲存Member照片
    public function save_change_password($data, $member, $request){
        $data['password'] = Hash::make($request->new_password);
        return $data;
    }
}
