@extends('admin.master')
@section('title','نتائج جميع المتقدمين')
@section('title-breadcrumb','تحليل النتائج')


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
                <div class="content standards-content2" style="margin-right:0 !important;">

                    <div class="title">
                        <h3>{{getAuthspecialization("specialization")}}</h3>
                        <button type="button" class="btn btn-primary add-field" data-bs-toggle="modal" data-bs-target="#staticBackdrop">طباعة النتائج                         </button>
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
            طباعة النتائج </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.result.users.exports')}}" method="POST" class="add-question">
            @csrf
          <label for="">من تاريخ</label>
          <input type="date" name="from" id="" placeholder="من تاريخ">
          <label for="">إلى تاريخ</label>
          <input type="date" name="to" id="" placeholder="إلى تاريخ">



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        <button type="submit" class="btn btn-primary">طباعة</button>
      </div>
    </form>
    </div>
  </div>
</div>
 </div>
                <!-- Button trigger modal -->


                <div class="order">
                    <form  method="GET" id="searchForm" class="all-schools-form3" style="display: flex; justify-content: space-between; align-content: center;">
                <div style="margin-bottom: 18px;">




                    <input type="text" style="padding: 10px; margin: 10px 0" value="{{request()->search}}" name="search" id="search" placeholder="بحث في البيانات">

                  </div>

            <div class="form-order">
                  <select name="sort" id="orderselect" onchange="orderUsers(this.value)">
                      <option {{request()->sort=='desc' ?'selected' :''}}  selected value="desc">من الأعلى إلى الأقل</option>

                    <option {{request()->sort=='asc'?'selected' :''}} value="asc">من الأقل إلى الأعلى </option>

                 </select>

                </div>
            </form>
              </div>
                </div>
<!-- Modal -->

                    <div class="table-responsive">
                        <table class="table table-bordered questions">
                          <thead>
                            <tr>
                              <th>الاسم  </th>
                              <th> العلامة      </th>
                              <th> التقييم الذاتي     </th>
                              <th>  التقييم الخارجي    </th>
                              <th> المستوى    </th>

                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><a href="{{route('admin.result.user.marks',$user->id)}}">{{$user->name}}</a> </td>
                                <td>{{$user->user_mark}}</td>
                                <td>{{$user->self_rating}}</td>
                                <td>{{$user->outer_rating??'غير مقيم'}}</td>
                                @php
                                    $level='القيادة المنجزة';
                                    if($user->level=='mastered')
                                    $level='القيادة المتقنة';
                                    elseif($user->level=='influential')
                                    $level='القيادة المؤثرة';

                                @endphp

                                <td>{{$level}}</td>
                              </tr>
                            @endforeach
                            @if ($users->count()==0)
                            <tr>
                               @php
                               $message="لا يوجد متقدمين حتى الان  ";
                               if(request()->search)
                                   $message="لا يوجد متقدمين بالبحث التالي". ": ".request()->search;
                                   if(request()->level)
                                   $message.=request()->level=='achieved'?'للمستوى القيادة المنجزة': ( (request()->level=='mastered'?'ومستوى القيادة المتقنة':'ومستوى القيادة المؤثرة'));
                               @endphp
                                <td colspan="5">{{$message}}</td>
                            </tr>

                            @endif







                          </tbody>
                        </table>
                        {{$users->withQuerystring()->links()}}

                      </div>

                </div>


@endsection

@push('scripts')
<script>
    function orderUsers(value)
    {
        $("#searchForm").submit();

    }

    $('#search').keypress(function(e){
        if(e.which == 13){//Enter key pressed
          $("#searchForm").submit();
        }
    });

</script>

@endpush
