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


          <td>@if($info->active==0) مفعل @else معطل @endif</td> 
   
      <td>
      
         <a href="{{ route('inv-item-card.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
         <a href="{{ route('inv-item-card.show',$info->id) }}" class="btn btn-sm   btn-info">عرض</a>  
         <form action="{{ route('inv-item-card.destroy',$info->id) }}" method="post" style=" display: inline-block;">
           <input class="btn btn-sm   btn-danger" type="submit" value="حذف" />
           @method('delete')
           @csrf
       </form>
     

    


      </td>
        

        </tr> 
   @php
      $i++; 
   @endphp
      @endforeach



         </tbody>
          </table>
      <br>

         
       
           @else
           <div class="alert alert-danger">
             عفوا لاتوجد بيانات لعرضها !!
           </div>
                 @endif