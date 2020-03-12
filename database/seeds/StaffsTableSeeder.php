<?php

use App\Handlers\BarcodeHandler;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            '',
        ];

        // 生成数据集合
        $Staffs = factory(Staff::class)
            ->times(10)
            ->make()
            ->each(function ($Staff, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $Staff->avatar = $faker->randomElement($avatars);
                $Staff->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.staff'), $index+1);
                $Staff->d_id = 1;
                $Staff->sex = 1;
                $Staff->avatar = '/images/default/avatars/avatar'.($index+1).'.jpg';
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $Staff_array = $Staffs->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        Staff::insert($Staff_array);

        $Staff = Staff::find(1);
        $Staff->name = 'Staff-1';
        $Staff->email = 'Staff1@app.com';
        $Staff->save();

        $Staff = Staff::find(2);
        $Staff->name = 'Staff-2';
        $Staff->email = 'Staff2@app.com';
        $Staff->save();

    }
}
