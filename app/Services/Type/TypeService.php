<?php

namespace App\Services\Type;

use App\Repositories\Type\TypeRepository;

class TypeService extends TypeCoreService
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
