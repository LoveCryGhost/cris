<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class ProductThumbnail extends Model
{

    protected $table = "products_thumbnails";
    protected $primaryKey='pt_id';

    protected $fillable = [
        'p_id',
        'sort_order',
        'path',
    ];
}
