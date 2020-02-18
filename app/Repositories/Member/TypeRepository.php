<?php

namespace App\Repositories\Member;


use App\Models\Type;

class TypeRepository implements TypeRepositoryInterface
{

    private $builder;

    public function __construct()
    {
        $this->builder = new Type();
    }

    public function builder()
    {
        return $this->builder ;
    }

    public function all()
    {
        return $this->builder->get() ;
    }

}
