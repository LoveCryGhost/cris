<?php

namespace App\Http\Controllers\User;



use App\Handlers\ImageUploadHandler;
use App\Http\Requests\User\UserRequest;
use App\Models\User;

class UsersController extends UserCoreController
{

    //顯示使用者資料
    public function show(User $user)
    {
        return view(config('theme.user.view').'user.show', compact('user'));
    }

    public function update(UserRequest $request,  ImageUploadHandler $uploader,User $user)
    {

        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show',['user'=>$user->id])
            ->with('toast', [
                "heading" => "個人訊息 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


}
