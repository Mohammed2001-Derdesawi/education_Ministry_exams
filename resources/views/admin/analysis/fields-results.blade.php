@extends('admin.master')
@section('title','النتائج')
@section('title-breadcrumb','النتائج')
@section('content')




                <div class="content standards-content">

                    <div class="title">
                        <h3>{{getAuthspecialization("specialization")}}</h3>

                    </div>
                <!-- Button trigger modal -->



                    <div class="table-responsive">
                      <h3 class="exams-intro">عدد المختبرين = {{$specialization->count_users}}</h3>
                        <table class="table table-striped table-bordered analysis">
                        <thead>
                      <tr>
                        <td class="table-primary">عدد الحاصلين على المستوى المنجز</td>
                        <td class="table-success">عدد الحاصلين على المستوى المتقن </td>
                        <td class="table-warning">عدد الحاصلين على المستوى المؤثر </td>
                      </tr>
                      <tr>
                        <td class="table-primary">{{$specialization->achieved_users_count}}</td>
                        <td class="table-success">{{$specialization->mastered_users_count}}</td>
                        <td class="table-warning">{{$specialization->influential_users_count}}</td>
                      </tr>
                      <tr>
                        <td class="table-primary"><a href="{{route('admin.result.users')}}?level=achieved">عرض</a></td>
                        <td class="table-success"><a href="{{route('admin.result.users')}}?level=mastered">عرض</a></td>
                        <td class="table-warning"><a href="{{route('admin.result.users')}}?level=influential">عرض</a></td>
                      </tr>
                     </tfoot>


                          </tbody>

                        </table>
                      </div>

                </div>




                @endsection
