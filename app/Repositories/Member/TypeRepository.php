<?php

namespace App\Repositories\Member;


use App\Models\Type;

class TypeRepository implements RepositoryInterface
{

    private $type;

    public function __construct(Type $type)
    {
        $this->type = new Type();
    }

    public function builder()
    {
        return $this->type ;
    }


}
