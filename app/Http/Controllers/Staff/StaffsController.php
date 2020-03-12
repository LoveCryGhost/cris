<?php

namespace App\Http\Controllers\Staff;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Staff;

class StaffsController extends StaffCoreController
{

    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    //Dashboard
    public function index(){
        return view(config('theme.staff.view').'staff.index');
    }

    //顯示使用者資料
    public function edit(Staff $staff)
    {
        $this->authorize('update', $staff);
        return view(config('theme.staff.view').'Staff.edit', compact('staff'));
    }

    public function update(StaffRequest $request,  ImageUploadHandler $uploader,Staff $staff)
    {
        $this->authorize('update', $staff);
        $data = $request->all();
        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $staff->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $staff->update($data);
        return redirect()->route('staff.edit',['staff' => $staff->id])
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
