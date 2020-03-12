<?php

namespace App\Models;

use Carbon\Carbon;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class StaffDepartment extends Authenticatable implements MustVerifyEmailContract
{

    protected $table = "staff_departments";
    protected $primaryKey='d_id';

    protected $fillable = [
        'dp_id', 'sort_order', 'is_active',
        'dp_code', 'name', 'description', 'local'
    ];



}
