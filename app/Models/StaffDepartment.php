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
        'parent_id', 'sort_order', 'is_active',
        'id_code', 'name', 'description', 'local'
    ];

    public $with =['parent'];

    public function parent()
    {
        return $this->belongsTo(StaffDepartment::class, 'parent_id', 'd_id');
    }

    public function children()
    {
        return $this->hasMany(StaffDepartment::class, 'parent_id');
    }


}
