@extends('layouts.admin-layout')
@section('name')
المشتريات@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">المشتريات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">المشتريات</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_get_item_uoms_url" value="{{ route('admin.suppliers_orders.get_item_uoms') }}">
          <h3 class="card-title card_title_center">تفاصيل فاتورة المشتريات  </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="ajax_responce_serarchDivparentpill">
        @if (@isset($data) && !@empty($data))
        
        <table id="example2" class="table table-bordered table-hover">
         
            <tr>
                <td class="width30"> كود الفاتورة الالي</td> 
                <td > {{ $data['auto_serial'] }}</td>
            </tr>
            <tr>
                <td class="width30">   كود الفاتورة بأصل فاتورة المشتريات </td> 
                <td > {{ $data['DOC_NO'] }}</td>
            </tr>
            <tr>
              <td class="width30">   تاريخ الفاتورة </td> 
              <td > {{ $data['order_date'] }}</td>
          </tr>
            <tr>
                <td class="width30">  اسم المورد </td> 
                <td > {{ $data['supplier_name'] }}</td>
            </tr>
            <tr>
                <td class="width30"> نوع الفاتورة</td> 
                <td > @if($data['pill_type']==1) كاش  @else اجل@endif</td>
            </tr>
            <tr>
              <td class="width30">   المخزن المستلم للفاتورة </td> 
              <td > {{ $data['store_name'] }}</td>
          </tr>

            
            <tr>
              <td class="width30">  اسم المورد </td> 
              <td > {{ $data['supplier_name'] }}</td>
          </tr>
          <tr>
            <td class="width30">   اجمالي الفاتورة </td> 
            <td > {{ $data['total_before_discount']*(1) }}</td> 
        </tr>


          @if ($data['discount_type']!=null)
            
          <tr>
            <td class="width30">   الخصم علي الفاتورة </td> 
            <td> 
              @if ($data['discount_type']==1)
            خصم نسبة ( {{ $data['discount_percent']*1 }} ) وقيمتها ( {{ $data["discount_value"]*1 }} )

              @else
              
      خصم يدوي وقيمته( {{ $data["discount_value"]*1 }} )

              @endif
            
            
            </td> 
        </tr>

          @else

          <tr>
            <td class="width30">   الخصم علي الفاتورة </td> 
            <td > لايوجد</td>
        </tr>

          @endif



          <tr>
            <td class="width30">    نسبة القيمة المضافة </td> 
            <td > 
            @if($data['tax_percent']>0)
            لايوجد
            @else
            بنسبة ({{ $data["tax_percent"]*1 }}) %  وقيمتها ( {{ $data['tax_value']*1 }} )
            @endif
            
            </td> 
        </tr>
        <tr>
          <td class="width30">       حالة الفاتورة </td> 
          <td > @if($data['is_approved']==1)  مغلق ومؤرشف @else مفتوحة  @endif</td>
      </tr>

           
            <tr>
                <td class="width30">  تاريخ  الاضافة</td> 
                <td > 
     
    @php
   $dt=new DateTime($data['created_at']);
   $date=$dt->format("Y-m-d");
   $time=$dt->format("h:i");
   $newDateTime=date("A",strtotime($time));
   $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
    @endphp
{{ $date }}
{{ $time }}
{{ $newDateTimeType }}
بواسطة 
{{ $data['added_by_admin'] }}

                </td>
            </tr> 



  
            <tr>
                <td class="width30">  تاريخ اخر تحديث</td> 
                <td > 
       @if($data['updated_by']>0 and $data['updated_by']!=null )
    @php
   $dt=new DateTime($data['updated_at']);
   $date=$dt->format("Y-m-d");
   $time=$dt->format("h:i");
   $newDateTime=date("A",strtotime($time));
   $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
    @endphp
{{ $date }}
{{ $time }}
{{ $newDateTimeType }}
بواسطة 
{{ $data['updated_by_admin'] }}





     @else
لايوجد تحديث
       @endif
       @if($data['is_approved']==0)
<a href="{{ route('admin.suppliers_orders.delete',$data['id']) }}" class="btn btn-sm are_you_shue  btn-danger">حذف</a>   
<a href="{{ route('admin.suppliers_orders.edit',$data['id']) }}" class="btn btn-sm btn-success">تعديل</a>
<button id="load_close_approve_invoice"  class="btn btn-sm btn-primary">تحميل الاعتماد والترحيل</button>

@endif

                </td>
            </tr> 
           
          </table>
      

          

        </div>

     <!--  treasuries_delivery   -->
     <div class="card-header">
        <h3 class="card-title card_title_center">
        الاصناف المضافة للفاتورة
        @if($data['is_approved']==0)
        {{-- id="load_modal_add_detailsBtn" --}}
        {{-- <button type="button" class="btn btn-info"   id="load_modal_add_detailsBtn" >
          اضافة صنف للفاتورة

        </button> --}}
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
          اضافة صنف للفاتورة
        </button>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-rg">
          Launch Large Modal
        </button>
       @endif
        </h3>
        <input type="hidden" id="token_search" value="{{csrf_token() }}">
        <input type="hidden" id="ajax_get_item_uoms_url" value="{{ route('admin.suppliers_orders.get_item_uoms') }}">
        <input type="hidden" id="ajax_add_new_details" value="{{ route('admin.suppliers_orders.add_new_details') }}">
        <input type="hidden" id="ajax_reload_items_details" value="{{ route('admin.suppliers_orders.reload_items_details') }}">
        <input type="hidden" id="ajax_reload_parent_pill" value="{{ route('admin.suppliers_orders.reload_parent_pill') }}">
        <input type="hidden" id="ajax_load_edit_item_details" value="{{ route('admin.suppliers_orders.load_edit_item_details') }}">
        <input type="hidden" id="ajax_load_modal_add_details" value="{{ route('admin.suppliers_orders.load_modal_add_details') }}">
        <input type="hidden" id="ajax_edit_item_details" value="{{ route('admin.suppliers_orders.edit_item_details') }}">
        <input type="hidden" id="ajax_load_modal_approve_invoice" value="{{ route('admin.suppliers_orders.load_modal_approve_invoice') }}">
        <input type="hidden" id="ajax_load_usershiftDiv" value="{{ route('admin.suppliers_orders.load_usershiftDiv') }}">

     
        <input type="hidden" id="auto_serial_parent" value="{{ $data['auto_serial'] }}">




    </div>
     <div id="ajax_response_search_div_details">
          
        @if (@isset($details) && !@empty($details) && count($details)>0)
        @php
         $i=1;   
        @endphp
        
        <table id="example2" class="table table-bordered table-hover">
          <thead class="custom_thead">
         <th>مسلسل</th>
         <th>الصنف </th>
         <th> الوحده</th>
         <th> الكمية</th>
         <th> السعر (NIS)</th>
         <th> الاجمالي (NIS) </th>

         <th></th>
          </thead>
          <tbody>
       @foreach ($details as $info )
          <tr>
           <td>{{ $i }}</td>  
         <td>{{ $info->item_card_name }}
        @if($info->item_card_type==2)
        <br>
        تاريخ انتاج  {{ $info->production_date }} <br>

        تاريخ انتهاء  {{ $info->expire_date }} <br>

        @endif
        
        
        </td>
         <td>{{ $info->uom_name }}</td>
         <td>{{ $info->delivered_quantity*(1) }}</td>
         <td>{{ $info->unit_price*(1) }}</td>
         <td>{{ $info->total_price*(1) }}</td>
    
         <td>
       @if($data['is_approved']==0)

       <button data-id="{{ $info->id }}" class="btn btn-sm load_edit_item_details  btn-primary">تعديل</button>   

       <a href="{{ route('admin.suppliers_orders.delete_details',["id"=>$info->id,"id_parent"=>$data['id']]) }}" class="btn btn-sm are_you_shue   btn-danger">حذف</a>   
     


       @endif

         </td>

         
 
         </tr> 
    @php
       $i++; 
    @endphp
       @endforeach
 
 
 
          </tbody>
           </table>
   
     
         @else
         <div class="alert alert-danger">
           عفوا لاتوجد بيانات لعرضها !!
         </div>
               @endif

      </div>
    



    <!--  End treasuries_delivery   -->



        @else
  <div class="alert alert-danger">
    عفوا لاتوجد بيانات لعرضها !!
  </div>
        @endif
      


        </div>
      </div>
    </div>
</div>


<div class="modal fade " id="Add_item_Modal">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title">اضافة اصناف للفاتورة</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="Add_item_Modal_body" style="background-color: white !important; color:black;">
    


      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">اضافة اصناف للفاتورة</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="Add_item_Modal_body" style="background-color: white !important; color:black;">
    
   <div class="row">
<div class="col-md-4">
  <div class="form-group"> 
    <label>   بيانات الأصناف</label>
    <select name="item_code_add" id="item_code_add" class="form-control select2">
      <option value="">اختر الصنف</option>
      @if (@isset($item_cards) && !@empty($item_cards))
     @foreach ($item_cards as $info )
       <option data-type="{{$info->item_type}}" value="{{ $info->id }}"> {{ $info->name }} </option>
     @endforeach
      @endif
    </select>
    @error('supplier_code')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

</div>
<div class="col-md-4 related_to_itemCard" style="display: none" id="UomDivAdd">
 
</div>
<div class="col-md-4 related_to_itemCard" style="display: none">

<div class="form-group">
  <label> الكمية المستلمة  </label>
  <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="qty_add" id="qty_add" class="form-control"  value="{{ old('qty_add') }}" placeholder="ادخل  عدد  الكمية"  >
  @error('qty_add')
  <span class="text-danger">{{ $message }}</span>
  @enderror
  </div>
 


</div>
<div class="col-md-4 related_to_itemCard" style="display: none">
  <div class="form-group">
    <label> سعر الوحدة </label>
    <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="price_add" id="price_add" class="form-control"  value="{{ old('price_add') }}" placeholder="ادخل  عدد  الكمية"  >
    @error('price_add')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
  </div> 
<div class="col-md-4 related_to_itemCard" style="display: none">
  <div class="form-group">
    <label> الإجمالي</label>
    <input readonly name="total_add" id="total_add" class="form-control"  value="{{ old('total_add') }}" placeholder="المجموع"  >
    
    </div>
  </div>
  <div class="col-md-4 related_to_date" style="display: none">
    <div class="form-group">
      <label> تاريخ الانتاج</label>
      <input type="date" name="production_date" id="production_date" class="form-control"  value="{{ old('production_date') }}">
      @error('production_date')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div> 
    <div class="col-md-4 related_to_date" style="display: none">
      <div class="form-group">
        <label> تاريخ الانتهاء</label>
        <input type="date" name="expiration_date" id="expiration_date" class="form-control"  value="{{ old('expiration_date') }}">
        @error('expiration_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div> 
      <div class="col-md-12 text-center" >
        <button type="button" class="btn btn-success" id="btn_addToPill" style="display: none; color:rgb(253, 253, 253);" data-dismiss="modal">اضف افاتورة</button>

      </div>
            
            <div class="modal-footer justify-content-left">
              <button type="button" class="btn btn-outline-light" style="color:black;" data-dismiss="modal">اغلاق</button>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      
    </div> </div>

{{-- -------------------- Start Model------------------------ --}}

    <div class="modal fade" id="modal-rg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">تحديث اصناف للفاتورة</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="edit_item_Modal_body" style="background-color: white !important; color:black;">
  
 <div class="row">    
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div> </div>

  {{-- ----------------------End Model---------------------- --}}

  {{-- -------------------- Start Model------------------------ --}}

  <div class="modal fade" id="model-rr">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">تحديث اصناف للفاتورة</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="ModalApproveInvocie_body" style="background-color: white !important; color:black;">

<div class="row">    
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div> </div>

{{-- ----------------------End Model---------------------- --}}


@endsection

@section("script")

<script  src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    </script>

{{-- <script  src="{{ asset('assets/admin/js/suppliers_with_order.js') }}"> </script> --}}
<script  src="{{ asset('assets/admin/js/suppliers_orders.js') }}"> </script>



@endsection
