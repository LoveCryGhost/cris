<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerItem extends Model
{

    protected $table = "crawler_items";
    protected $primaryKey = 'ci_id';

    protected $fillable = [
        'is_active',
        'itemid', 'shopid',
        'name',
        'images', 'sold', 'historical_sold', 'local'
    ];


    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }

    public function crawlerItemSKUs(){
        return $this->hasMany(CrawlerItemSKU::class, 'ci_id');
    }
}
