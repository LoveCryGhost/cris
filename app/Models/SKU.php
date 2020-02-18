<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{

    protected $table = "skus";
    protected $primaryKey='sku_id';

    protected $with = [];
    protected $fillable = [
        'sku_name',
        'thumbnail',
        'm_price',
        't_price',
    ];


    protected $casts = [
        'm_price' => 'decimal',
        't_price' => 'decimal'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'p_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
}
