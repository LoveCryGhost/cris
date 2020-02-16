<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class Attribute extends Model
{
    protected $table = "attributes";
    protected $primaryKey='a_id';

    protected $fillable = [
        'is_active', 'a_name', 'a_description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
