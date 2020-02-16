<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;

class AttributeService extends MemberCoreService
{
    protected $typeRepo;

    public function __construct(AttributeRepository $typeRepository)
    {
        $this->typeRepo = $typeRepository;
    }

    public function all(){
        return $this->typeRepo->all(0);
    }


}
