@extends('admin.master')
@section('title','إضافة معيار')
@section('title-breadcrumb','المعايير')
@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">إضافة معيار</li>
@endsection


@section('content')





                <!-- Button trigger modal -->

                  <div class="title">
                    <h3>{{getAuthspecialization("specialization")}}</h3>
                    <h4>إضافة معيار جديد</h4>
                </div>

                  <form action="{{route('admin.norms.store')}}" method="POST" class="add-standard">
                       @csrf
                      <select name="field" id="" class="fields-name-1">
                        @foreach ($fields as $field)
                        <option value="{{$field->id}}">{{$field->name}}</option>
                        @endforeach

                      </select>
                      <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("field")}}

                    </span>

                       <input type="text" value="{{old("norm")}}" name="norm" placeholder=" اسم المعيار" class="fields-name-1">
                       <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("norm")}}

                    </span>

                       <h5>المؤشرات</h5>
                       <div class="indicators">
                        <div class="one-index">
                          <input type="text" name="standards[first][standard]" value="{{old("standards")['first']['standard']??null}}" placeholder=" اسم المؤشر الأول">
                          <input type="text"  name="standards[first][mark]" value="{{old("standards")['first']['mark']??null}}" placeholder=" عدد النقاط  " class="points">
                        </div>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.first.standard")}}

                        </span>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.first.mark")}}

                        </span>
                        <div class="one-index">
                          <input type="text"  name="standards[seconed][standard]"  value="{{old("standards")["seconed"]['standard']??null}}" placeholder=" اسم المؤشر الثاني">
                          <input type="text"  name="standards[seconed][mark]" value="{{old("standards")["seconed"]["mark"]??null}}" placeholder=" عدد النقاط  " class="points" >
                        </div>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.seconed.standard")}}

                        </span>
                        <span class="text-danger" style="padding-bottom: 10px;">
                            {{$errors->first("standards.seconed.mark")}}

                        </span>

                        <div class="one-index">
                          <input type="text"  name="standards[third][standard]" value="{{old("standards")["third"]["standard"]??null}}" placeholder=" اسم المؤشر الثالث">
                          <input type="text"  name="standards[third][mark]" value="{{old("standards")["third"]["mark"]??null}}" placeholder=" عدد النقاط  " class="points">
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




