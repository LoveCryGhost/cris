<?php

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use App\Models\Product;
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
            $index = 1;
            foreach ($types as $type){
                Type::create([
                    'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.type'), $index++),
                    'is_active' => 1,
                    't_name' => $type,
                    't_description' => "",
                    'member_id' => 1,
                ]);
            }

            $index = 1;
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
            $type=Type::find(5)->attributes()->attach([1,3]);

        //Products
            //烘培
            $products = [
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'name' => "Pizza 烤盤", 't_id' => 1, 'c_ids' => [2],

                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'name' => "吐司烤盤", 't_id' => 1, 'c_ids' => [2],
                ]
            ];

            //面膜
            $products = array_merge($products,[
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'name' => "潑尿酸面膜", 't_id' => 2, 'c_ids' => [8]
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'name' => "保濕SKU面膜", 't_id' => 2, 'c_ids' => [10],
                ]]);
            //男裝

            //女裝

            //童裝

            $index=1;
            foreach ($products as $product){
                $product['id_code'] = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $index++);
                $c_ids = $product['c_ids'];
                unset($product['c_ids']);
                $product= Product::create($product);
                $product->categories()->attach($c_ids);

            }
    }
}