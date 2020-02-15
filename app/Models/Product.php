<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;;

class Product extends Model
{

    protected $table = "products";
    protected $primaryKey='p_id';

    protected $fillable = [
        'publish_at',
        't_id',
        'name',
        'c_id',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories','p_id','c_id')
            ->withTimestamps();
    }

    public function thumbnails(){
        return $this->hasMany(ProductThumbnail::class, 'p_id');
    }
}
