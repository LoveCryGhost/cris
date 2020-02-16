<?php

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Type;
use Illuminate\Database\Seeder;

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
                    'p_name' => "Pizza 烤盤", 't_id' => 1,
                    'c_ids' => [2],
                    'pt_ids' => ['/images/default/products/pizza_pan_1.jpg', '/images/default/products/pizza_pan_2.jpg']

                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "吐司烤盤", 't_id' => 1,
                    'c_ids' => [2],
                    'pt_ids' => ['/images/default/products/toast_pan_1.jpg', '/images/default/products/toast_pan_2.jpg', '/images/default/products/toast_pan_3.jpg']
                ]
            ];

            //面膜
            $products = array_merge($products,[
                [
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "潑尿酸面膜", 't_id' => 2,
                    'c_ids' => [8],
                    'pt_ids' => ['/images/default/products/mask_1.jpg', '/images/default/products/mask_2.jpg', '/images/default/products/mask_3.jpg']
                ],[
                    'is_active' => 1, 'publish_at' => null, 'member_id' => 1,
                    'p_name' => "保濕SKU面膜", 't_id' => 2,
                    'c_ids' => [10],
                    'pt_ids' => ['/images/default/products/mask_4.jpg']
                ]]);
            //男裝

            //女裝

            //童裝

            $index=1;
            foreach ($products as $product){
                $product['id_code'] = (new BarcodeHandler())->barcode_generation(config('barcode.product'), $index++);
                $c_ids = $product['c_ids'];
                $pt_ids = $product['pt_ids'];
                unset($product['c_ids']);
                unset($product['pt_ids']);

                $product=  Product::create($product);
                $product->categories()->attach($c_ids);

                $productThumbnails =[];
                foreach ($pt_ids as $key => $thumbnail_path){
                    $productThumbnail = ProductThumbnail::get();
                    $productThumbnail->path = $thumbnail_path;
                    $productThumbnail->p_id = $product->p_id;
                    $productThumbnail->save();
//                    $productThumbnails[] = $productThumbnail;
//                    $product->thumbnails()->saveMany($productThumbnails);
                }
            }
    }
}