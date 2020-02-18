<?php

namespace App\Repositories\Member;


use App\Models\Member;

class MemberRepository implements RepositoryInterface
{


    private $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

//  取出Member數量
    public function all($row_qty)
    {
        return Member::paginate($row_qty);
    }

//    儲存相片
    public function save_avatar(){
        return 'test in Repo';
    }

    public function builder()
    {
        return $this->member;
    }
}
