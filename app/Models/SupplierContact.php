<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model
{
    protected $table = "supplier_contacts";

    protected $primaryKey='sc_id';

    protected $with = [];

    protected $fillable = [
        'is_active', 'sc_name', "name_card",
        "tel", "phone", 'introduction'
    ];

    protected $casts = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
