@extends('admin.master')
@section('title',$field->name)
@section('title-breadcrumb',$field->name)

@section('content')


<div class="content standards-content">

    <div class="title">
        <h3>{{getAuthspecialization("specialization")}}</h3>

    </div>
<!-- Button trigger modal -->



    <div class="table-responsive">
        <table class="table table-striped table-bordered analysis">
          <thead>
            <tr>
              <th colspan="3" class="table-warning">{{$field->name}}</th>
            </tr>
            <tr>

              <th > المعيار     </th>
              <th > المؤشر     </th>
              <th>  النقاط    </th>


            </tr>
          </thead>
          <tbody>
            @php
                $total_achieved=0;
                $total_mastered=0;
                $total_influential=0;
            @endphp
            @foreach ($field->norms as $norm)


            <tr>

              <td>{{$norm->norm}}</td>
              <td><ul>
                @foreach ($norm->standards as $standard)
                <li>اسم  المؤشر الأول</li>
                <hr>
                @endforeach



              </ul></td>
              <td><ul>

                @foreach ($norm->standards as $standard)
                @if ($standard->mark==2)
                {{$total_achieved+=2}}


                @elseif ($standard->mark==4)
                {{$total_mastered+=4}}

                @else
                {{$total_influential+=6}}
                @endif
                <li>{{$standard->mark}}</li>
                <hr>
                @endforeach



              </ul></td>

            </tr>
            @endforeach
            @if ($field->norms()->count()==0)
            <tr>
                <td colspan="3">لا يوجد معايير مضافة لهذا المجال</td>
            </tr>

            @endif


     <tfoot >
      <tr >
        <td class="table-primary">المستوى المنجز</td>
        <td class="table-success" >المستوى المتقن</td>
        <td class="table-warning" colspan="2">المستوى المؤثر</td>
      </tr>
      <tr>
        <td class="table-primary">عدد النقاط ({{$total_achieved}})</td>
        <td class="table-success" >عدد النقاط ({{$total_mastered}})</td>
        <td class="table-warning" colspan="2">عدد النقاط ({{$total_influential}})</td>
      </tr>
     </tfoot>


          </tbody>

        </table>
      </div>

</div>






@endsection

