<?php

use App\Handlers\BarcodeHandler;
use App\Models\Supplier;
use App\Models\SupplierGroup;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        $supplier_groups = [
            [
                "sg_name" => "貨運行-1",
            ],[
                "sg_name" => "貨運行-2",
            ],[
                "sg_name" => "貨運行-3",
            ]
        ];

        $index = 1;
        foreach ($supplier_groups as $supplier_group){
            SupplierGroup::create([
                'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.supplierGroup'), $index++),
                'is_active' => 0,
                'sg_name' => $supplier_group['sg_name'],
            ]);
        }



        $suppliers = [
            [
                "s_name" => "供應商-1",
            ],[
                "s_name" => "供應商-2",
            ],[
                "s_name" => "供應商-3",
            ]
        ];

        $index = 1;
        foreach ($suppliers as $supplier){
            Supplier::create([
                'sg_id' => rand(1,3),
                'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.supplierGroup'), $index++),
                'is_active' => 1,
                's_name' => $supplier['s_name'],
            ]);
        }
    }
}