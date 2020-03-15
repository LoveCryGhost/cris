<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Admin\AdminStaffRequest;
use App\Models\Staff;
use App\Services\Staff\StaffService;
use Illuminate\Http\Request;

/**

 */
class AdminStaffsController extends AdminCoreController
{

    protected $staffService;
    public function __construct(StaffService $staffService)
    {
        $this->middleware('auth:admin');
        $this->StaffService = $staffService;
    }

    //Dashboard
    public function index(){
        $staffs = Staff::withCount(['StaffLogs'])->paginate(5);
        return view(config('theme.admin.view').'staff.index', compact('Staffs'));
    }

    public function edit(Staff $staff){
        return view(config('theme.admin.view').'staff.edit', compact('Staff'));
    }

    public function update(AdminStaffRequest $request , ImageUploadHandler $uploader, Staff $staff)
    {
        $data = $request->all();

        $data = $this->StaffService->save_avatar($data, $staff,$request, $uploader);

        $staff->update($data);
        return redirect()->route('admin.Staff.index')
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
    public function update_password(Request $request, Staff $staff)
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
        $data = $this->StaffService->save_change_password($data, $staff,$request);

        $staff->update($data);
        return redirect()->route('admin.Staff.edit', ['Staff'=> $staff->id])
            ->with('toast', [
                "heading" => "Staff 密碼 - 更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }


    public function create(){
        return view(config('theme.admin.view').'staff.create', compact(''));
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
