@extends('layouts.admin-layout')

@section('name')
بيانات   الاصناف@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">بيانات   الاصناف</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">بيانات   الاصناف</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection


@section('content')


  
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات   الاصناف</h3>
          {{-- <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('inv-item-card.ajax_search') }}">
         --}}
          <a href="{{ route('inv-item-card.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
          <div class="col-md-4">
            <input checked type="radio" name="searchbyradio" id="searchbyradio" value="barcode"> بالباركود
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="item_code"> بالكود
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="name"> بالاسم

            <input style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder=" اسم - باركود - كود للصنف" class="form-control"> <br>
            
                      </div>
                      <div class="col-md-4"> 
                        <div class="form-group"> 
                          <label>  بحث بنوع الصنف</label>
                          <select name="item_type_search" id="item_type_search" class="form-control">
                           <option value="all"> بحث بالكل</option>
                          <option   value="1"> مخزني</option>
                          <option  value="2"> استهلاكي بتاريخ صلاحية</option>
                          <option   value="3"> عهدة</option>
                          </select>
                        
                          @error('item_type')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        
                        <div class="col-md-4"> 
                          <div class="form-group"> 
                            <label>   بحث بفئة الصنف</label>

                            <select name="inv_itemcard_categories_id_search" id="inv_itemcard_categories_id_search" class="form-control ">
                           <option value="all"> بحث بالكل</option>
                              @if (@isset($inv_item_card_categories) && !@empty($inv_item_card_categories))
                             @foreach ($inv_item_card_categories as $info )
                               <option value="{{ $info->id }}"> {{ $info->name }} </option>
                             @endforeach
                              @endif
                            </select>
                            @error('inv_itemcard_categories_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
               <div class="clearfix"></div>

        <div id="ajax_responce_serarchDiv" class="col-md-12">
          
          @if (@isset($data) && !@empty($data))
          @php
           $i=1;   
          @endphp
          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
              <th>كود آلي </th>
           <th>الاسم </th>
           <th> النوع </th>
           <th> الفئة </th>
           <th> الوحدة الاب </th>
           <th>  الكمية الحالية </th>
           <th>حالة التفعيل</th>
         
           <th></th>

            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>
             <td>{{ $info->item_code }}</td>  
             <td>{{ $info->name }}</td>  
             <td>@if($info->item_type==1) مخزني  @elseif($info->item_type==2) استهلاكي بصلاحية   @elseif($info->item_type==3) عهدة @else غير محدد @endif</td>  
             <td>{{ $info->inv_item_card_categories_id }}</td>  
             <td>{{ $info->Uom_name }}</td>  
             <td>{{ $info->all_qty*1 }} {{ $info->Uom_name }}</td>  


             <td>@if($info->active==1) مفعل @else معطل @endif</td> 
      
         <td>

        <a href="{{ route('inv-item-card.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
        <a href="{{ route('inv-item-card.show',$info->id) }}" class="btn btn-sm   btn-info">عرض</a>   

         </td>
           
   
           </tr> 
      @php
         $i++; 
      @endphp
         @endforeach
   
   
   
            </tbody>
             </table>
             
      <br>
           {{ $data->links() }}
       
           @else
           <div class="alert alert-danger">
             عفوا لاتوجد بيانات لعرضها !!
           </div>
                 @endif

        </div>
      
      
      
      </div>

        </div>
     
</div>





@endsection

@section('script')
<script src="{{ asset('assets/admin/js/inv_itemcard.js') }}"></script>

@endsection
