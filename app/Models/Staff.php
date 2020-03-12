<?php

namespace App\Models;

use Carbon\Carbon;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class Staff extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

    protected $table = "staffs";
    protected $primaryKey='id';

    protected $fillable = [
        'id_code', 'pic',
        'staff_code', 'is_active', 'is_block',

        'name', 'sex', 'identify_code',
        'avatar',

        'birthday',

        'interview_at', 'join_at', 'social_security_at',
        'apply_for_leave_at', 'leave_at',

        'email',

        'tel1', 'phone1', 'address_fix',
        'tel2', 'phone2', 'address_current',

        'note',

        'introduced_by', 'interviewed_by',

        //學歷
        'education1_from', 'education1_to', 'education1_level', 'school1_name',
        'education2_from', 'education2_to', 'education2_level', 'school2_name',

        //經歷
        'experience1_from', 'experience1_to', 'company1_name',
        'experience2_from', 'experience2_to', 'company2_name',

        //聯繫人
        'contact1', 'contact_tel1', 'contact_phone1',
        'contact2', 'contact_tel2', 'contact_phone2',

        //dorm
        'dorm_number',



        'photo_id1', 'photo_id2',

        'level',

        //國家
        'local',

    ];
}
