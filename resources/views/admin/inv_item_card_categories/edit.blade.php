@extends('layouts.admin-layout')

@section('name')
فئات الاصناف@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">فئات الاصناف</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">فئات الاصناف</li>
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
          <h3 class="card-title card_title_center">تعديل بيانات  فئة الاصناف</h3>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if (@isset($data) && !@empty($data))
      <form action="{{ route('inv-item-card-categories.update',$data['id']) }}" method="post" >
        @method('PUT')
        @csrf
        
      <div class="form-group">
        <label>اسم فئة الصنف</label>
        <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"   >
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        
        
        <div class="form-group"> 
          <label>  حالة التفعيل</label>
          <select name="active" id="active" class="form-control">
           <option value="">اختر الحالة</option>
          <option   @if(old('active')==0) selected="selected"  @endif value="0"> نعم</option>
           <option @if(old('active')==1 and old('active')!="" ) selected="selected"   @endif value="1"> لا</option>
        
          </select>
          @error('is_master')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
      <div class="form-group text-center">
<button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
<a href="{{ route('inv-item-card-categories.index') }}" class="btn btn-sm btn-danger">الغاء</a>    

      </div>

    
    </form>  

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
