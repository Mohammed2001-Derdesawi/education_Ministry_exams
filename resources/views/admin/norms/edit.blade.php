@extends('admin.master')
@section('title','تعديل معيار')
@section('title-breadcrumb','تعديل معيار')
@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">إضافة معيار</li>
@endsection


@section('content')





                <!-- Button trigger modal -->

                  <div class="title">
                    <h3>{{getAuthspecialization("specialization")}}</h3>
                </div>

                  <form action="{{route('admin.norms.update',$norm->id)}}" method="POST" class="add-standard">
                    @method('PUT')
                       @csrf
                      <select name="field" id="" class="fields-name-1">
                        @foreach ($fields as $field)
                        <option {{$norm->field->id==$field->id ? 'selected' : ''}} value="{{$field->id}}">{{$field->name}}</option>
                        @endforeach

                      </select>
                      <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("field")}}

                    </span>

                       <input type="text" value="{{$norm->norm}}" name="norm" placeholder=" اسم المعيار" class="fields-name-1">
                       <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("norm")}}

                    </span>

                       <h5>المؤشرات</h5>
                       <div class="indicators">
                        <div class="one-index">

                            <input type="text" name="standards[first][standard]" value="{{$norm->standards->first()->standard}}" placeholder=" اسم المؤشر الأول">
                            <input type="text"  name="standards[first][mark]" value="{{$norm->standards->first()->mark}}" placeholder=" عدد النقاط  " class="points">


                        </div>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.first.standard")}}

                        </span>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.first.mark")}}

                        </span>
                        <div class="one-index">
                          <input type="text"  name="standards[seconed][standard]"  value="{{$norm->standards->skip(1)->first()->standard}}" placeholder=" اسم المؤشر الثاني">
                          <input type="text"  name="standards[seconed][mark]" value="{{$norm->standards->skip(1)->first()->mark}}" placeholder=" عدد النقاط  " class="points" >
                        </div>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.seconed.standard")}}

                        </span>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.seconed.mark")}}

                        </span>

                        <div class="one-index">
                          <input type="text"  name="standards[third][standard]" value="{{$norm->standards->skip(2)->first()->standard}}" placeholder=" اسم المؤشر الثالث">
                          <input type="text"  name="standards[third][mark]" value="{{$norm->standards->skip(2)->first()->mark}}" placeholder=" عدد النقاط  " class="points">
                        </div>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.third.standard")}}

                        </span>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.third.mark")}}

                        </span>

                       </div>
                       <span class="text-danger" style="padding-bottom: 10px;">


                    </span>


                       <button type="submit" class="add-btn-standard">إضافة
                      </button>
                  </form>










                @endsection




