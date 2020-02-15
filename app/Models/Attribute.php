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
        'is_active', 't_name', 't_description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
