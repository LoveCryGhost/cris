<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            '/images/default/icons/avatars/avatar_big_1.jpeg',
            '/images/default/icons/avatars/avatar_big_2.jpeg',
            '/images/default/icons/avatars/avatar_big_3.jpeg',
            '/images/default/icons/avatars/avatar_big_4.jpeg',
            '/images/default/icons/avatars/avatar_big_5.jpeg',
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        $user = User::find(1);
        $user->name = 'user';
        $user->email = 'user@app.com';
        $user->avatar = '/images/default/icons/avatars/avatar_big_1.jpeg';
        $user->save();

    }
}