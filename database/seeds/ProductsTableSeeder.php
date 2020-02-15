<?php

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        //Types
            $types = [
                 '烘培用品', '面膜', '男裝', '女裝', '童裝'
            ];



        //Attribute
            $attributes = [
                '顏色', '材質', '尺寸',
            ];


            //輸入資料庫中
            $index = 0;
            foreach ($types as $type){
                Type::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.type'), $index++),
                    'is_active' => 1,
                    't_name' => $type,
                    't_description' => "",
                    'member_id' => 1,
                ]);
            }

            $index = 0;
            foreach ($attributes as $attribute){
                Attribute::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $index++),
                    'is_active' => 1,
                    'a_name' => $attribute,
                    'a_description' => "",
                    'member_id' => 1,
                ]);
            }

        //TypeAttribute
            $type=Type::find(1)->attributes()->attach([1,2,3]);
            $type=Type::find(2)->attributes()->attach([1]);
            $type=Type::find(3)->attributes()->attach([1,3]);
            $type=Type::find(4)->attributes()->attach([1,3]);
            $type=Type::find(4)->attributes()->attach([1,3]);

        //Products

    }
}