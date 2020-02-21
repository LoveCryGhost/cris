<?php

namespace App\Repositories\Member;


use App\Models\Supplier;

class SupplierRepository implements RepositoryInterface
{

    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = new Supplier();
    }

    public function builder()
    {
        return $this->supplier ;
    }


    public function getById($id)
    {
        return $this->supplier->find($id);
    }
}
