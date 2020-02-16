<?php

namespace App\Services\Member;

use App\Repositories\Member\TypeRepository;

class TypeService extends MemberCoreService
{
    protected $typeRepo;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepo = $typeRepository;
    }

    public function all(){
        return $this->typeRepo->all(0);
    }


}
