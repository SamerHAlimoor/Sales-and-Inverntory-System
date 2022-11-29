<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesMaterialTypesRequest;
use App\Models\Admin;
use App\Models\SalesMaterialTypes;
use Illuminate\Http\Request;

class SalesMaterialTypeController extends Controller
{
    //

    public function index()
    {
        $data = SalesMaterialTypes::select()->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);

        if (!empty($data)) {
            foreach ($data as $info) {
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                if ($info->updated_by > 0 and $info->updated_by != null) {
                    $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                }
            }
        }
        return view('admin.sales_material_types.index', ['data' => $data]);
    }
    public function create()
    {
        return view('admin.sales_material_types.create');
    }
    public function store(SalesMaterialTypesRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            //check if not exsits
            $checkExists = SalesMaterialTypes::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['active'] = $request->active;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date("Y-m-d");
                SalesMaterialTypes::create($data);
                return redirect()->route('admin.sales_material_types.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الفئة مسجل من قبل'])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function edit($id)
    {
        $data = SalesMaterialTypes::select()->find($id);
        return view('admin.sales_material_types.edit', ['data' => $data]);
    }
    public function update($id, SalesMaterialTypesRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = SalesMaterialTypes::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.sales_material_types.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = SalesMaterialTypes::where(['name' => $request->name, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name'] = $request->name;
            $data_to_update['active'] = $request->active;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            SalesMaterialTypes::where(['id' => $id, 'com_code' => $com_code])->update($data_to_update);
            return redirect()->route('admin.sales_material_types.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function delete($id)
    {
        try {
            $Sales_matrial_types_row = SalesMaterialTypes::find($id);
            if (!empty($Sales_matrial_types_row)) {
                $flag = $Sales_matrial_types_row->delete();
                if ($flag) {
                    return redirect()->back()
                        ->with(['success' => '   تم حذف البيانات بنجاح']);
                } else {
                    return redirect()->back()
                        ->with(['error' => 'عفوا حدث خطأ ما']);
                }
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
}