<?php

namespace App\Http\Controllers\Admin;

use App\Models\Treasuries;
use App\Models\Admin;
use App\Models\Treasuries_delivery;
use App\Http\Requests\TreasuriesRequest;
use App\Http\Requests\Addtreasuries_deliveryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\TreasuriesRequestDelivery;
use App\Models\TreasuriesDelivery;
use App\Models\Treasury;
use Illuminate\Http\Request;

class TreasuriesController extends Controller
{
    public function index()
    {
        $data = Treasury::select()->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                if ($info->updated_by > 0 and $info->updated_by != null) {
                    $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                }
            }
        }
        return view('admin.treasuries.index', ['data' => $data]);
    }
    public function create()
    {
        return view('admin.treasuries.create');
    }
    public function store(TreasuriesRequest $request)
    {
        //return $request;
        try {
            $com_code = auth()->user()->com_code;
            //check if not exsits
            $checkExists = Treasury::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                if ($request->is_master == 1) {
                    $checkExists_isMaster = Treasury::where(['is_master' => 1, 'com_code' => $com_code])->first();
                    if ($checkExists_isMaster != null) {
                        return redirect()->back()
                            ->with(['error' => 'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
                            ->withInput();
                    }
                }
                $data['name'] = $request->name;
                $data['is_master'] = $request->is_master;
                $data['last_receipt_exchange'] = $request->last_receipt_exchange;
                $data['last_receipt_collect'] = $request->last_receipt_collect;
                $data['address'] = $request->address;
                $data['phone'] = $request->phone;
                //address
                $data['active'] = $request->active;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date("Y-m-d");
                // return $data['data'];
                Treasury::create($data);
                return redirect()->route('admin.treasuries.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])
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
        $data = Treasury::select()->find($id);
        return view('admin.treasuries.edit', ['data' => $data]);
    }
    public function update($id, TreasuriesRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Treasury::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = Treasury::where(['name' => $request->name, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput();
            }
            if ($request->is_master == 1) {
                $checkExists_isMaster = Treasury::where(['is_master' => 1, 'com_code' => $com_code])->where('id', '!=', $id)->first();
                if ($checkExists_isMaster != null) {
                    return redirect()->back()
                        ->with(['error' => 'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
                        ->withInput();
                }
            }
            $data_to_update['name'] = $request->name;
            $data_to_update['active'] = $request->active;
            $data_to_update['is_master'] = $request->is_master;
            $data_to_update['last_receipt_exchange'] = $request->last_receipt_exchange;
            $data_to_update['last_receipt_collect'] = $request->last_receipt_collect;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            Treasury::where(['id' => $id, 'com_code' => $com_code])->update($data_to_update);
            return redirect()->route('admin.treasuries.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput(); // save the last values
        }
    }
    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $data = Treasury::where('name', 'LIKE', "%{$search_by_text}%")->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
            return view('admin.treasuries.ajax_search', ['data' => $data]);
        }
    }
    public function details($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Treasury::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $data['added_by_admin'] = Admin::where('id', $data['added_by'])->value('name');
            if ($data['updated_by'] > 0 and $data['updated_by'] != null) {
                $data['updated_by_admin'] = Admin::where('id', $data['updated_by'])->value('name');
            }
            $treasuries_delivery = TreasuriesDelivery::select()->where(['treasuries_id' => $id])->orderby('id', 'DESC')->get();
            //dd($treasuries_delivery);
            if (!empty($treasuries_delivery)) {
                foreach ($treasuries_delivery as $info) {
                    $info->name = Treasury::where('id', $info->treasuries_can_delivery_id)->value('name');
                    $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                }
            }
            return view("admin.treasuries.details", ['data' => $data, 'treasuries_delivery' => $treasuries_delivery]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
    public function add_treasuries_delivery($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Treasury::select('id', 'name')->find($id);
            // dd($data);
            if (empty($data)) {
                return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $Treasuries = Treasury::select('id', 'name')->where(['com_code' => $com_code, 'active' => 0])->get();
            return view("admin.treasuries.add_treasuries_delivery", ['data' => $data, 'Treasuries' => $Treasuries]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
    public function store_treasuries_delivery($id, TreasuriesRequestDelivery $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $Treasuries = new Treasury();
            $data = Treasury::select('id', 'name')->find($id);
            if (empty($data)) {
                return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = TreasuriesDelivery::where(['treasuries_id' => $id, 'treasuries_can_delivery_id' => $request->treasuries_can_delivery_id, 'com_code' => $com_code])->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا هذه الخزنة مسجلة من قبل !'])
                    ->withInput();
            }
            $data_insert_details['treasuries_id'] = $id;
            $data_insert_details['treasuries_can_delivery_id'] = $request->treasuries_can_delivery_id;
            $data_insert_details['created_at'] = date("Y-m-d H:i:s");
            $data_insert_details['added_by'] = auth()->user()->id;
            $data_insert_details['com_code'] = $com_code;
            TreasuriesDelivery::create($data_insert_details);
            return redirect()->route('admin.treasuries.details', $id)->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
    public function delete_treasuries_delivery($id)
    {
        try {
            $treasuries_delivery = TreasuriesDelivery::find($id);
            if (!empty($treasuries_delivery)) {
                $flag = $treasuries_delivery->delete();
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