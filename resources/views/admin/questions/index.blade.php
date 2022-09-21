@extends('admin.master')
@section('title','جميع الأسئلة')
@section('title-breadcrumb','إضافة سؤال جديد')

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
                        <h3>{{ getAuthspecialization("specialization")}}</h3>
                        <button type="button" class="btn btn-primary add-field" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          إضافة سؤال جديد
                         </button>
                    </div>
                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          إضافة سؤال جديد </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.questions.store')}}" method="POST" class="add-question" enctype="multipart/form-data" >
            @csrf

         <select name="norm">
            @foreach ($norms as $norm)
            <option value="{{$norm->id}}">{{$norm->norm}}</option>
            @endforeach
            @if ($norms->count()==0)
            <option value="0">لا يوجد معايير</option>

            @endif
         </select>
         <textarea  name="question" id="" cols="30" rows="5" placeholder="أضف السؤال هنا"></textarea>
         <input type="file" name="photo" id="" class="file-inp">

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

    <input type="text" style="padding: 10px; margin: 10px 57px" value="{{request()->search}}" name="search" id="search" placeholder="بحث في البيانات">
</form>
                    <div class="table-responsive" style="margin-bottom: 90px;">
                        <table class="table table-bordered questions table-striped">
                          <thead>
                            <tr>
                              <th>اسم المجال</th>
                              <th> اسم المعيار</th>
                              <th>  السؤال </th>
                              <th> المؤشرات</th>
                              <th>الإجراءات</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($questions as $question)


                            <tr>
                              <td>{{$question->norm->field->name}}</td>
                              <td>
                                {{$question->norm->norm}}
                              </td>
                              <td>
                                {{$question->question}}
                              </td>
                              <td class="indexes">
                                <ul>
                                  @foreach ($question->norm->standards as $standard)
                                    <li>{{$standard->standard}}</li>
                                    @if (!$loop->last)
                                    <hr>

                                    @endif
                                  @endforeach
                                </ul>
                              </td>
                              <td>
                                <ul class="actions">


                                      <li>
                                        <button onclick="appendData({{$question}})" type="button" class="btn edit-field" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                          <i class="fa-solid fa-pen-to-square"></i>
                                          تعديل
                                         </button>


                                         <form action="{{route('admin.questions.destroy',$question->id)}}" method="post">
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

                            @if ($questions->count()==0)
                            @php
                            $message="لا يوجد أسئلة مضافة";
                            if(request()->search)
                                $message="لا يوجد أسئلة بالبحث التالي". ": ".request()->search
                            @endphp
                            <tr>
                                <td colspan="5">{{$message}}</td>
                            </tr>

                            @endif



                          </tbody>

                        </table>

                        <div class="modal fade " id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel2">
                                    تعديل سؤال  </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form  class="add-question" id="updatequestion" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                   <select name="norm" id="norm">
                                    @foreach ($norms as $norm)
                                    <option value="{{$norm->id}}">{{$norm->norm}}</option>
                                    @endforeach
                                   </select>
                                   <textarea id="question" style="padding: 10px 8px" name="question" id="" cols="30" rows="5" placeholder="أضف السؤال هنا"></textarea>
                                   <input type="file"  name="photo" id="photo" class="file-inp">

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                  <button type="submit" class="btn btn-primary">تعديل</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                          {{$questions->withQuerystring()->links()}}

                      </div>


                      @endsection
                      @push('scripts')
                      <script>
                          $('#search').keypress(function(e){
                              if(e.which == 13){//Enter key pressed
                                $("#searchForm").submit();
                              }
                          });

                          function appendData(question)
                            {

                             $("#updatequestion").attr("action",window.location+"/"+question.id)
                                  $("#question").val(question.question)
                                  $('#norm option[value="'+question.norm.id+'"]').prop('selected',true)
                            }
                      </script>

                      @endpush
