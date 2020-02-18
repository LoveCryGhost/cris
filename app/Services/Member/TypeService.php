<?php

namespace App\Services\Member;

use App\Repositories\Member\TypeRepository;

class TypeService extends MemberCoreService implements MemberServiceInterface
{
    public $typeRepo;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepo = $typeRepository;
    }

    public function index()
    {
        return $this->typeRepo->builder()->paginate(10);
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store($data)
    {
        $this->typeRepo->builder()->create($data);
        return parent::$toast_store;
    }

    public function update($model,$data)
    {
        $type = $model;
        $type->update($data);
        return parent::$toast_update;
    }

    public function destroy($model)
    {
        $type = $model;
        $type->delete();
        return parent::$toast_destroy;
    }


}
