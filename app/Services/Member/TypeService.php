<?php

namespace App\Services\Member;

use App\Repositories\Member\TypeRepository;

class TypeService extends MemberCoreService implements MemberServiceInterface
{
    protected $typeRepo;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepo = $typeRepository;
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

    public function destroy()
    {

    }


}
