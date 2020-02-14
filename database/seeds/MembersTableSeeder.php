<?php

use App\Models\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
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
        $members = factory(Member::class)
            ->times(10)
            ->make()
            ->each(function ($member, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $member->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $member_array = $members->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        Member::insert($member_array);

        $member = Member::find(1);
        $member->name = 'member';
        $member->email = 'member@app.com';
        $member->avatar = '';
        $member->save();

    }
}