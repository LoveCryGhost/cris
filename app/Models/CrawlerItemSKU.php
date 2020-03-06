<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class CrawlerItemSKU extends Model
{

    protected $table = "citem_skus";
    protected $primaryKey='ci_id';
//    protected $primaryKey=['shopid', 'itemid', 'modelid'];

    protected $fillable = [
        'ci_id', 'itemid', 'shopid', 'modelid',
        'name', 'local', 'sold', 'stock'
    ];

    protected $hidden = [

    ];

    protected $casts = [
    ];

    public function getPriceAttribute($value)
    {
        return $value/10000;
    }
    public function CrawlerItemSKUDetails()
    {
        return $this->hasMany(CrawlerItemSKUDetail::class, 'modelid', 'modelid')
                ->where('shopid', $this->shopid)
                ->where('itemid', $this->itemid)
                ->take(1);
    }

    public function CrawlerItemSKUDetails_7records()
    {
        return $this->hasMany(CrawlerItemSKUDetail::class, 'modelid', 'modelid')
            ->where('shopid', $this->shopid)
            ->where('itemid', $this->itemid)
            ->take(7);
    }


}
