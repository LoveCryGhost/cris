<?php

namespace App\Repositories\Member;

use App\Models\Attribute;

class AttributeRepository implements RepositoryInterface
{

    private $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = new Attribute();
    }

    public function builder()
    {
        return $this->attribute ;
    }
}
