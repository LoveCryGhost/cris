<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminUserRequest;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

/**

 */
class AdminUsersController extends AdminCoreController
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:admin');
        $this->userService = $userService;
    }

    //Dashboard
    public function index(){
        $users = User::withCount(['userLogs'])->paginate(5);
        return view(config('theme.admin.view').'user.index', compact('users'));
    }

    public function edit(User $user){
        return view(config('theme.admin.view').'user.edit', compact('user'));
    }

    public function update(AdminUserRequest $request , ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        $data = $this->userService->save_avatar($data, $user,$request, $uploader);

        $user->update($data);
        return redirect()->route('admin.user.index')
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

    //更新密碼
    public function update_password(Request $request, User $user)
    {
        //驗證
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'new_password.required' => '新密碼不能為空 且 最少為8位數字',
            'new_password.min' => '新密碼不能為空 且 最少為8位數字',
            'new_password.confirmed' => '密碼必須一致',
        ]);

        $data = $request->all();
        $data = $this->userService->save_change_password($data, $user,$request);

        $user->update($data);
        return redirect()->route('admin.user.edit', ['user'=> $user->id])
            ->with('toast', [
                "heading" => "User 密碼 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


    public function create(){
        return view(config('theme.admin.view').'user.create', compact(''));
    }

//    //顯示使用者資料
//    public function edit(Admin $admin)
//    {
//        $this->authorize('update', $admin);
//        return view(config('theme.admin.view').'admin.edit', compact('admin'));
//    }
//
//    public function update(AdminRequest $request,  ImageUploadHandler $uploader,Admin $admin)
//    {
//        $this->authorize('update', $admin);
//        $data = $request->all();
//        if($request->avatar) {
//            $result = $uploader->save($request->avatar, 'avatars', $admin->id, 416);
//            if ($result) {
//                $data['avatar'] = $result['path'];
//            }
//        }
//        $admin->update($data);
//        return redirect()->route('admin.edit',['admin'=>$admin->id])
//            ->with('toast', [
//                "heading" => "個人訊息 - 更新成功",
//                "text" =>  '',
//                "position" => "top-right",
//                "loaderBg" => "#ff6849",
//                "icon" => "success",
//                "hideAfter" => 3000,
//                "stack" => 6
//            ]);
//    }


}
