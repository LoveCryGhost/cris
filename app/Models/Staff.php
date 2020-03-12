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
        'is_active', 'd_id', 'pic',
        'name', 'avatar', 'level', 'birthday',
        'sex', 'identify_code', 'photo_id1', 'photo_id2',
        'tel1', 'phone1', 'contact1',
        'tel2', 'phone2', 'contact2',
        'address_fix', 'address_current',
        'introduction',
        'joint_at',
        'social_security_at',
        'apply_for_leave_at',
        'leave_at',
        'education1_from',
        'education1_to',
        'education1_level',
        'school1_name',
        'education2_from',
        'education2_to',
        'education2_level',
        'school2_name',
        'experience1_from',
        'experience1_to',
        'company1_name',
        'salary1',
        'experience2_from',
        'experience2_to',
        'company2_name',
        'salary2',
        'local',

    ];
}
