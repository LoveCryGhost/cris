<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Member\Product_SKU_SupplierRequest;
use App\Http\Requests\Staff\Staff_DepartmentRequest;
use App\Models\StaffDepartment;
use App\Services\Staff\Staff_DepartmentService;
use Illuminate\Http\Request;

class Staff_DepartmentsController extends StaffCoreController
{
    private $staff_DepartmentService;

    public function __construct(Staff_DepartmentService $staff_DepartmentService)
    {
        $this->middleware('auth:staff');
        $this->staff_DepartmentService = $staff_DepartmentService;
    }


//    public function index(Request $request)
//    {
//        return [
//            'errors' => '',
//            'models'=> [
//                'sku' => '',
//            ],
//            'request' => $request->all(),
//            'view' => 'xxxxxx',
//            'options'=>[]
//        ];
//    }

//    public function create(Request $request)
//    {
//        $data = $request->all();
//
//        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
//        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();
//        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-create', compact('sku', 'suppliers'))->render();
//        return [
//            'errors' => '',
//            'models'=> [
//                'sku' => $sku,
//                'suppliers' => $suppliers
//            ],
//            'request' => $request->all(),
//            'view' => $view,
//            'options'=>[]
//        ];
//    }

    public function edit()
    {
        $data = request()->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $staff_department_current_pivot = $staff->staffDepartments()->wherePivot('sd_id',$data['sd_id'])->get()->last()->pivot;
        $staffDepartments = StaffDepartment::get();
        $view = view(config('theme.staff.view').'staff.staffDepartment.md-edit',compact('data','staff','staffDepartments', 'staff_department_current_pivot'))->render();

        return [
            'errors' => '',
            'models'=> [
                'sku' => '',
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }



    public function update(Staff_DepartmentRequest $request)
    {
        $data = $request->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $TF =$this->staff_DepartmentService->update($model = $staff, $data);

        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        return [
            'errors' => '',
            'models'=> [
                'staff' => $staff,
                ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function store(Product_SKU_SupplierRequest $request)
    {
        $data = $request->all();
        $TF = $this->product_SKU_SupplierService->store($data);
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);

        $skuSupplier = $this->product_SKU_SupplierService->supplierRepo->getById($data['s_id']);
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'skuSupplier' => $skuSupplier,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }
//
//    public function destroy(Attribute $attribute)
//    {
//        $toast = $this->attributeService->destroy($attribute);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
}
