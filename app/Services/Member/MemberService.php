<?php

namespace App\Services\Member;

use App\Repositories\Member\MemberRepositoryInterface;

class MemberService extends MemberCoreService
{
    protected $memberRepo;

    public function __construct(MemberRepositoryInterface $memberRepository)
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
}
