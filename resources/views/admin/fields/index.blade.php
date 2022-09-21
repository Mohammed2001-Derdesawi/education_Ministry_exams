
@extends('admin.master')
@section('title','الصفحة الرئيسية|المجالات')
@section('title-breadcrumb','المجالات')


@section('content')
<ul class="text-center" style="display: flex;justify-content: center;align-items: center;flex-direction: column;list-style-type: none">

    @foreach ($errors->messages() as $error)
     <div style="width:fit-content" class="text-center">
        <li>

            <div class="alert alert-danger" role="alert">
                {{$error[0]}}
            </div>

        </li>
     </div>

    @endforeach
 </ul>

                    <div class="title">
                        <h3>{{getAuthspecialization("specialization")}}</h3>
                        <button type="button" class="btn btn-primary add-field" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          إضافة مجال جديد
                         </button>
                    </div>
                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          إضافة مجال جديد </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.fields.store')}}" method="POST">
            @csrf
          <label for="">اسم المجال</label>
          <input type="text" name="name" placeholder="أدخل اسم المجال">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        <button type="submit" class="btn btn-primary">إضافة</button>
      </div>
    </form>
    </div>
  </div>
</div>
<form  method="GET" id="searchForm" class="all-schools-form3">

    <input type="text" style="padding: 10px; margin: 10px 157px" value="{{request()->search}}" name="search" id="search" placeholder="بحث في البيانات">
</form>
                    <div class="table-responsive">
                        <table class="table table-bordered fields">
                          <thead>
                            <tr>
                              <th>اسم المجال</th>

                              <th>الإجراءات</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($fields as $field)

                            <tr>
                              <td>{{$field->name}}</td>
                              <td>
                                <ul class="actions">
                                   <li>
                                    <a href="{{route('admin.fields.show',$field->id)}}"><i class="fa-solid fa-eye"></i>
                                      عرض</a>
                                      <button type="button" onclick="appendData({{$field}})" class="btn  edit-field" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" >
                                          <i class="fa-solid fa-pen-to-square"></i>
                                            تعديل
                                      </button>


                                    <form action="{{route('admin.fields.destroy',$field->id)}}" method="post">
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

                            @if ($fields->count()==0)
                            <tr>
                               @php
                               $message="لا يوجد مجالات مضافة";
                               if(request()->search)
                                   $message="لا يوجد مجالات بالبحث التالي". ": ".request()->search
                               @endphp
                                <td colspan="2">{{$message}}</td>
                            </tr>

                            @endif


                          </tbody>

                        </table>

                          <!-- Modal -->
                          <div class="modal fade " id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel1">
                                    تعديل مجال جديد </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form id="updatefield">
                                    @method('PUT')
                                    @csrf
                                    <label for="">اسم المجال</label>
                                    <input type="text" name="name" placeholder="أدخل اسم المجال" value="" id="edit_name">

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                  <button type="submit" class="btn btn-primary">تعديل</button>
                                </div>
                            </form>
                              </div>
                            </div>

                          </div>

                          {{$fields->withQuerystring()->links()}}
                      </div>


                      @endsection

@push('scripts')
<script>
    $('#search').keypress(function(e){
        if(e.which == 13){//Enter key pressed
          $("#searchForm").submit();
        }
    });

    function appendData(field)
    {

        $("#updatefield").attr("action",window.location+"/"+field.id)
        $("#updatefield").attr("method",'POST')
        $("#edit_name").attr("value",field.name)
    }
</script>
@endpush
