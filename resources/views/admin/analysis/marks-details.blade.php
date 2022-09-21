@extends('admin.master')
@section('title','تفاصيل التقييم')
@section('title-breadcrumb','تفاصيل التقييم')
@section('content')



                        <div class="title">
                          <h4 class="standard-qu">نتيجة اختبار المقياس</h4>
                          @php
                          $level='القيادة المنجزة';
                          if($user->level=='mastered')
                          $level='القيادة المتقنة';
                          elseif($user->level=='influential')
                          $level='القيادة المؤثرة';

                      @endphp
                          <span>النتيجة النهائية : مستوى {{$level}}  </span>
                          <a href="{{route('admin.result.user.rating.page',$user->id)}}"  class="btn btn-primary add-field evaluate">
                            إعادة التقييم
                        </a>
                        </div>

                        <div class="result-table">
                          <div class="table-responsive">
                            <table class="table table-striped">


                              <tr>
                                <th>النقاط</th>
                                <th> المعيار</th>
                                <th>المؤشر</th>
                              </tr>
                              <tr>
                                <td rowspan="{{$marks->get(2)?$marks->get(2)->count()+1:2}}" class="table-danger">2</td>
                                <td>اسم المعيار</td>
                                <td>المؤشر الذي تم اختياره</td>

                              </tr>
                              @if ($marks->has(2))
                               @foreach ($marks->get(2) as $mark)
                               <tr>
                                <td>{{$mark->norm->norm}}</td>
                                <td>{{$mark->standard}}</td>
                               </tr>

                               @endforeach
                               @else
                               <tr rowspan="0">
                                <td colspan="2">لا يوجد معايير مختارة بنقاط 2</td>
                               </tr>

                               @endif
                              <tr>
                                <td rowspan="{{$marks->get(4)?$marks->get(4)->count():2}}" class="table-success">4</td>
                                 @if ($first=$marks->get(4)?$marks->get(4)->first():null)
                                 <td>{{$first->norm->norm}}</td>
                                 <td>{{$first->standard}}</td>

                                 @endif

                              </tr>
                              @if ($marks->has(4))
                               @foreach ($marks->get(4)->skip(1) as $mark)
                               <tr>
                                <td>{{$mark->norm->norm}}</td>
                                <td>{{$mark->standard}}</td>
                               </tr>

                               @endforeach
                               @else
                               <tr rowspan="0">
                                <td colspan="2">لا يوجد معايير مختارة بنقاط 4 </td>
                               </tr>

                               @endif
                              <tr>
                                <td rowspan="{{$marks->get(6)?$marks->get(6)->count():0}}" class="table-info">6</td>
                                @if ($first=$marks->get(6)?$marks->get(6)->first():null)
                                <td>{{$first->norm->norm}}</td>
                                <td>{{$first->standard}}</td>

                                @endif

                              </tr>
                              @if ($marks->has(6))
                               @foreach ($marks->get(6)->skip(1) as $mark)
                               <tr>
                                <td>{{$mark->norm->norm}}</td>
                                <td>{{$mark->standard}}</td>
                               </tr>

                               @endforeach
                               @else
                               <tr rowspan="0">
                                <td colspan="2">لا يوجد معايير مختارة بنقاط 6</td>
                               </tr>

                               @endif
                            </table>


                          </div>

                        </div>


                        @endsection






