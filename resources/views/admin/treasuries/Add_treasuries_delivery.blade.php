@extends('layouts.admin-layout')

@section('name')
Treasury Page
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Treasury Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Treasury</li>
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
          <h3 class="card-title card_title_center">اضافة خزن للاستلام منها للخزنة ({{ $data['name'] }})</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
    
      <form action="{{ route('admin.treasuries.store_treasuries_delivery',$data['id']) }}" method="post" >
        @csrf

<div class="form-group">
  <label>  اختر الخزنة الفرعية</label>
  <select name="treasuries_can_delivery_id" id="treasuries_can_delivery_id" class="form-control ">
   <option value="">اختر الخزنة</option>
   @if (@isset($Treasuries) && !@empty($Treasuries))
  @foreach ($Treasuries as $info )
    <option @if(old('treasuries_can_delivery_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
  @endforeach

   @endif

  </select>
  @error('treasuries_can_delivery_id')
  <span class="text-danger">{{ $message }}</span>
  @enderror
      <div class="form-group text-center"> <br>
        <button type="submit" class="btn btn-primary btn-sm">اضافة </button>
        <a href="{{ route('admin.treasuries.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      
      </div>
        
            
            </form>  
        
            

            </div>  

      


        </div>
      </div>
    </div>
</div>





@endsection

