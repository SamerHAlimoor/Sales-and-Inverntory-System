@extends('layouts.admin-layout')

@section('name')
بيانات وحدات القياس للأصناف
@endsection

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
          <h3 class="card-title card_title_center">بيانات   وحدات القياس للأصناف</h3>
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('admin.uoms.ajax_search') }}">
        
          <a href="{{ route('admin.uoms.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
          <div class="col-md-4">
            <label>    بحث بالاسم</label>

            <input type="text" id="search_by_text" placeholder="بحث بالاسم" class="form-control"> <br>
            
                      </div>
                      <div class="col-md-4">
                      <div class="form-group"> 
                        <label>    بحث بالنوع</label>
                        <select name="is_master_search" id="is_master_search" class="form-control">
                         <option value="all"> بحث بالكل</option>
                        <option  value="1"> وحدة اب</option>
                         <option value="0"> وحدة تجزئة</option>
                        </select>
                       
                        </div>
                      </div>
               <div class="clearfix"></div>
               <div class="col-md-12">      
        <div id="ajax_responce_serarchDiv">
          
          @if (@isset($data) && !@empty($data))
          @php
           $i=1;   
          @endphp
          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
           <th>مسلسل</th>
           <th>اسم الوحدة</th>
           <th> نوع الوحدة</th>
           <th>حالة التفعيل</th>
           <th> تاريخ الاضافة</th>
           <th> تاريخ التحديث</th>
           <th></th>

            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>
             <td>{{ $i }}</td>  
             <td>{{ $info->name }}</td>  
             <td>@if($info->is_master==1) وحدة أب @else وحدة تجزئة @endif</td> 

             <td>@if($info->active==0) مفعل @else معطل @endif</td> 
             <td > 
              {{  date("Y-m-d -- h:i A", $info->created_by) }}

               <br>
          بواسطة 
          {{ $info->added_by_admin}}
          
          
                          </td>
                          
     <td > 
  @if($info->updated_by>0 and $info->updated_by!=null )
  {{  date("Y-m-d -- H:i A", strtotime($info->updated_by)) }}

                          <br>
                     بواسطة 
                     {{ $data['updated_by_admin'] }}
                          @else
                     لايوجد تحديث
                            @endif
                     
       </td>           

             
         <td>


        <a href="{{ route('admin.uoms.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
   
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
     
</div>





@endsection

@section('script')
<script src="{{ asset('assets/admin/js/inv_uoms.js') }}"></script>

@endsection