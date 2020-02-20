<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierGroup extends Model
{

    protected $table = "supplier_groups";
    protected $primaryKey='sg_id';

    protected $with = [];
    protected $fillable = [
        'sg_name',
        "name_card",
        "add_company",
        "wh_company",
        "tel",
        "phone",
        "company_id",
        "website",
    ];


    protected $casts = [
    ];


}
