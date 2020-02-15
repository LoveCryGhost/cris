<?php

namespace App\Repositories\Member;



interface MemberRepositoryInterface{

    public function all($row_qty);

    public function save_avatar();
}
