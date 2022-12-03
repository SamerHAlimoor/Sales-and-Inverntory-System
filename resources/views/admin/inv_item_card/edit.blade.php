@extends('layouts.admin-layout')

@section('name')
بيانات وحدات القياس للأصناف@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">بيانات وحدات القياس للأصناف</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">بيانات وحدات القياس للأصناف</li>
          </ol>
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> تعديل بيانات صنف </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
       
      
      <form action="{{ route('inv-item-card.update',$data['id']) }}"  method="POST" enctype="multipart/form-data" >
      
        <div class="row">
        @csrf
      

        <div class="col-md-6">    
      <div class="form-group">
<label>  باركود الصنف   </label>
<input name="barcode" id="barcode" class="form-control" value="{{ old('name',$data['barcode']) }}" placeholder="ادخل  باركود الصنف"  >
@error('barcode')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-md-6">   
<div class="form-group">
  <label>اسم  الصنف</label>
  <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}" placeholder="ادخل اسم الصنف"   >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>
<div class="col-md-6"> 
<div class="form-group"> 
  <label>  نوع الصنف</label>
  <select name="item_type" id="item_type" class="form-control">
   <option value="">اختر النوع</option> 
  <option {{  old('item_type',$data['item_type'])==1 ? 'selected' : ''}}   value="1" > مخزني</option>
  <option {{  old('item_type',$data['item_type'])==2 ? 'selected' : ''}}   value="2" > استهلاكي بتاريخ صلاحية</option>
  <option {{  old('item_type',$data['item_type'])==3 ? 'selected' : ''}}   value="3" > عهدة</option>
  </select>

  @error('item_type')
  <span class="text-danger">{{ $message }}</span>
  @enderror
  </div>
</div>

<div class="col-md-6"> 
  <div class="form-group"> 
    <label>  فئة الصنف</label>
    <select name="inv_item_card_categories_id" id="inv_itemcard_categories_id" class="form-control ">
      <option value="">اختر الفئة</option>
      @if (@isset($inv_itemcard_categories) && !@empty($inv_itemcard_categories))
     @foreach ($inv_itemcard_categories as $info )
       <option {{  old('inv_item_card_categories_id',$data['inv_item_card_categories_id'])==$info->id ? 'selected' : ''}} value="{{ $info->id }}"> {{ $info->name }} </option>
     @endforeach
      @endif
    </select>
    @error('inv_item_card_categories_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
  </div>
  <div class="col-md-6"> 
    <div class="form-group"> 
      <label>   الصنف الاب له</label>
      <select name="parent_inv_item_card_id" id="parent_inv_item_card_id" class="form-control ">
        <option selected value="0"> هو اب</option>
        @if (@isset($item_card_data) && !@empty($item_card_data))
       @foreach ($item_card_data as $info )
         <option {{  old('parent_inv_item_card_id',$data['parent_inv_item_card_id'])==$info->id ? 'selected' : ''}} value="{{ $info->id }}"> {{ $info->name }} </option>
       @endforeach
        @endif
      </select>
      @error('inv_itemcard_categories_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>
  <div class="col-md-6"> 
    <div class="form-group"> 
      <label>   وحدة القياس الاب</label>
      <select name="uom_id" id="uom_id" class="form-control ">
        <option value="">اختر الوحدة الاب</option>
        @if (@isset($inv_uoms_parent) && !@empty($inv_uoms_parent))
       @foreach ($inv_uoms_parent as $info )
         <option {{  old('uom_id',$data['uom_id'])==$info->id ? 'selected' : ''}} value="{{ $info->id }}"> {{ $info->name }} </option>
       @endforeach
        @endif
      </select>
      @error('uom_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>

    <div class="col-md-6"> 
      <div class="form-group"> 
        <label>   هل للصنف وحدة تجزئة ابن</label>
        <select name="does_has_retail_unit" id="does_has_retail_unit" class="form-control">
         <option value="">اختر الحالة</option>
        <option {{  old('does_has_retail_unit',$data['does_has_retail_unit'])==1 ? 'selected' : ''}} value="1"> نعم </option>
        <option {{  old('does_has_retail_unit',$data['does_has_retail_unit'])==0 ? 'selected' : ''}} value="0"> لا</option>
      </select>
      
        @error('does_has_retail_unit')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>


      <div class="col-md-6  " @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 ) style="display: none;" @endif  id="retail_uom_idDiv"> 
        <div class="form-group"> 
          <label>   وحدة القياس التجزئة الابن بالنسبة للأب(<span class="parentuomname"></span>)</label>
          <select  name="retail_uom_id" id="retail_uom_id" class="form-control ">
            <option value="">اختر الوحدة الاب</option>
            @if (@isset($inv_uoms_child) && !@empty($inv_uoms_child))
           @foreach ($inv_uoms_child as $info )
             <option {{  old('retail_uom_id',$data['retail_uom_id'])==$info->id ? 'selected' : ''}} value="{{ $info->id }}"> {{ $info->name }} </option>
           @endforeach
            @endif
          </select>
          @error('retail_uom_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>
        <div class="col-md-6 relatied_retial_counter "  @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 )  style="display: none;" @endif> 

        <div class="form-group">
          <label>عدد وحدات التجزئة  (<span class="childuomname"></span>) بالنسبة للأب (<span class="parentuomname"></span>)  </label>
          <input  oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="retail_uom_qty_to_parent" id="retail_uom_qty_to_parent" class="form-control"  value="{{ old('retail_uom_quntToParent',$data['retail_uom_quntToParent']*1) }}" placeholder="ادخل  عدد وحدات التجزئة"  >
          @error('retail_uom_qty_to_parent')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>


 <div class="col-md-6 relatied_parent_counter "> 

        <div class="form-group">
          <label>سعر القطاعي بوحدة (<span class="parentuomname"></span>)  </label>
          <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="price" id="price" class="form-control"  value="{{ old('price',$data['price']*1) }}" placeholder="ادخل السعر " >
          @error('price')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>
        <div class="col-md-6 relatied_parent_counter "  > 
          <div class="form-group">
            <label>سعر النص جملة بوحدة (<span class="parentuomname"></span>)  </label>
            <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="nos_bulk_price" id="nos_bulk_price" class="form-control"  value="{{ old('nos_bulk_price',$data['nos_gomla_price']*1) }}" placeholder="ادخل السعر " >
            @error('nos_bulk_price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div>

          <div class="col-md-6 relatied_parent_counter " > 
            <div class="form-group">
              <label>سعر  جملة بوحدة (<span class="parentuomname"></span>)  </label>
              <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="bulk_price" id="bulk_price" class="form-control"  value="{{ old('bulk_price',$data['bulk_price']*1) }}" placeholder="ادخل السعر " >
              @error('bulk_price')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>
            </div>
            <div class="col-md-6 relatied_parent_counter "  > 
              <div class="form-group">
                <label>سعر  تكلفة الشراء لوحدة (<span class="parentuomname"></span>)  </label>
                <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="cost_price" id="cost_price" class="form-control"  value="{{ old('cost_price',$data['cost_price']*1) }}" placeholder="ادخل السعر " >
                @error('cost_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
              </div>

              <div class="col-md-6 relatied_retial_counter " @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 ) style="display: none;" @endif> 

                <div class="form-group">
                  <label>سعر القطاعي بوحدة (<span class="childuomname"></span>)  </label>
                  <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="price_retail" id="price_retail" class="form-control"  value="{{ old('price_retail',$data['price_retail']*1) }}" placeholder="ادخل السعر " >
                  @error('price_retail')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-md-6 relatied_retial_counter " @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 ) style="display: none;" @endif> 
                  <div class="form-group">
                    <label>سعر النص جملة بوحدة (<span class="childuomname"></span>)  </label>
                    <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="nos_bulk_price_retail" id="nos_bulk_price_retail" class="form-control"  value="{{ old('nos_bulk_price_retail',$data['nos_bulk_price_retail']*1) }}" placeholder="ادخل السعر " >
                    @error('nos_bulk_price_retail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
  
                  <div class="col-md-6 relatied_retial_counter " @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 ) style="display: none;" @endif> 
                    <div class="form-group">
                      <label>سعر  الجملة بوحدة (<span class="childuomname"></span>)  </label>
                      <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="bulk_price_retail" id="bulk_price_retail" class="form-control"  value="{{ old('bulk_price_retail',$data['bulk_price_retail']*1) }}" placeholder="ادخل السعر " >
                      @error('bulk_price_retail')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>


                    <div class="col-md-6 relatied_retial_counter " @if(old('does_has_retail_unit',$data['does_has_retail_unit'])!=1 ) style="display: none;" @endif> 
                      <div class="form-group">
                        <label>سعر  الشراء بوحدة (<span class="childuomname"></span>)  </label>
                        <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="cost_price_retail" id="cost_price_retail" class="form-control"  value="{{ old('cost_price_retail',$data['cost_price_retail']*1) }}" placeholder="ادخل السعر " >
                        @error('cost_price_retail')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group"> 
                          <label>  هل للصنف سعر ثابت  </label>
                          <select name="has_fixced_price" id="has_fixced_price" class="form-control">
                           <option value="">اختر الحالة</option>
                          <option   {{  old('has_fixced_price',$data['has_fixced_price'])==1 ? 'selected' : ''}} value="1"> نعم ثابت ولايتغير بالفواتير</option>
                           <option {{  old('has_fixced_price',$data['has_fixced_price'])==0 ? 'selected' : ''}} value="0"> لا وقابل للتغير بالفواتير</option>
                          </select>
                          @error('has_fixced_price')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>

<div class="col-md-6">
      <div class="form-group"> 
        <label>  حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
         <option value="">اختر الحالة</option>
        <option  {{  old('active',$data['active'])==1 ? 'selected' : ''}} value="1"> نعم</option>
         <option {{  old('active',$data['active'])==0 ? 'selected' : ''}} value="0"> لا</option>
        </select>
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
     
      <div class="col-md-6" style="">
        <div class="form-group"> 
          <label>   صورة الصنف ان وجدت</label>
       <img id="uploadedimg" src="#" alt="" style="width: 150px; width: 150px;" >        
       <input onchange="readURL(this)" type="file" id="item_img" name="item_img" class="form-control">
       <button type="button" class="btn btn-sm btn-danger" id="update_image">تغير الصورة</button>
       <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_update_image"> الغاء</button>
       
          @error('active')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>  
 <div class="col-md-6">
  <div class="form-group">
    <div id="oldimage">
      <img class="custom_img" style="width: 200px; width: 200px;" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
    </div>  
  </div>
 </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_edit_item_cardd" type="submit" class="btn btn-primary btn-sm"> حفظ التعديلات</button>
        <a href="{{ route('inv-item-card.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      
      </div>
    </div>
    
  
            </form>  
        
            

            </div>  

      


        </div>
      </div>
   





@endsection


@section('script')
<script src="{{ asset('assets/admin/js/inv_itemcard.js') }}"></script>
<script>
var uom_id=$("#uom_id").val();
if(uom_id!=""){
  var name=$("#uom_id option:selected").text();  
    $(".parentuomname").text(name); 
}
var uomretail_uom_id_id=$("#retail_uom_id").val();
if(retail_uom_id!=""){
  var name=$("#retail_uom_id option:selected").text();  
    $(".childuomname").text(name); 
}
</script>

@endsection



