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
    public function builder()
    {
        return $this->member;
    }
}
