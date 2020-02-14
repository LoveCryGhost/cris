<?php

namespace App\Repositories\Member;


use App\Models\Member;

interface MemberRepositoryInterface{

    public function all($row_qty);

    public function save_avatar();
}
