<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $table = "suppliers";
    protected $primaryKey='s_id';

    protected $with = [];
    protected $fillable = [
        'is_active',
        's_name',
        'sg_id',
        "name_card",
        "add_company",
        "wh_company",
        "tel",
        "phone",
        "company_id",
        "website",
        "introduction"
    ];


    protected $casts = [
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function supplierContacts($paginate=0)
    {
        return $this->hasMany(SupplierContact::class, 's_id')->paginate($paginate);
    }
}
