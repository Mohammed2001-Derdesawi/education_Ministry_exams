
@extends('admin.master')
@section('title','المعايير')
@section('title-breadcrumb','المعايير')

@section('content')









                <div class="content standards-content">

                    <div class="title">
                        <h3>{{getAuthspecialization("specialization")}}</h3>
                        <a href="{{route('admin.norms.create')}}" type="button" class="btn btn-primary add-field">
                          إضافة معيار جديد
                         </a>
                    </div>


                    <form  method="GET" id="searchForm" class="all-schools-form3">

                        <input type="text" style="padding: 10px; margin: 10px 60px" value="{{request()->search}}" name="search" id="search" placeholder="بحث في البيانات">
                    </form>

<div class="table-responsive" style="margin-bottom: 80px;">
  <table class="table table-bordered standards-tab">
    <thead>
      <tr>
        <th>اسم المعيار </th>
        <th>اسم المجال </th>
        <th> مؤشرات المعيار  </th>
        <th>الإجراءات     </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($norms as $norm)


      <tr>
        <td>{{$norm->norm}}</td>
        <td>{{$norm->field->name}}</td>
        <td>
          <ul>

            @foreach ($norm->standards as $standard)
                <li>{{$standard->standard}}</li>
                @if (!$loop->last)
                <hr>
                @endif

            @endforeach
        </ul></td>
        <td>
          <ul class="actions">


                <li>
                  <a href="{{route('admin.norms.edit',$norm->id)}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                      تعديل
                  </a>



                  <form action="{{route('admin.norms.destroy',$norm->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn"><i class="fa-solid fa-trash"></i>
                        حذف</button>
                    </form>

              </li>



          </ul>
        </td>
      </tr>
      @endforeach
      @if ($norms->count()==0)
      <tr>
         @php
         $message="لا يوجد معايير مضافة";
         if(request()->search)
             $message="لا يوجد معايير بالبحث التالي". ": ".request()->search
         @endphp
          <td colspan="4">{{$message}}</td>
      </tr>

      @endif


    </tbody>

  </table>
  {{$norms->withQuerystring()->links()}}
</div>

                </div>



                @endsection

@push('scripts')
<script>
    $('#search').keypress(function(e){
        if(e.which == 13){//Enter key pressed
          $("#searchForm").submit();
        }
    });
    </script>

@endpush


