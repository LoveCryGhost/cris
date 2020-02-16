<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = "products";
    protected $primaryKey='p_id';

    protected $with = ['productThumbnails','member'];
    protected $fillable = [
        'publish_at',
        't_id',
        'p_name',
        'c_id', 'p_id'
    ];


    protected $casts = [
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories','p_id','c_id')
            ->withTimestamps();
    }

    public function productThumbnails(){
        return $this->hasMany(ProductThumbnail::class, 'p_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
}
