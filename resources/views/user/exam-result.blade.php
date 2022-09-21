<!DOCTYPE html>
<html lang="ar" dir="rtl">
    @php
        $title="نتيجة المقياس";
    @endphp
@include('user.layouts.head')
<body>

@include('user.layouts.header')
<div class="container">
    <div class="content content-exam">
      <div class="title">
        <img src="img/237168f0-bca7-4ba4-b7e6-8709c7e861f9.jfif" alt="">
        <h4 class="standard-qu">نتيجة اختبار المقياس</h4>
        <span>النسبة النهائية :{{$user_mark}}%</span>
        <span>النتيجة النهائية : {{$level}}</span>
      </div>

      <div class="result-table">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th> المجال</th>
                <th>المعيار   </th>
                <th>المؤشر الذي تم اختياره   </th>
                <th> النقاط</th>

              </tr>

            </thead>
            <tbody>
                @php
                    $standards_ids=[];
                @endphp
                @foreach ($marks as $mark)


              <tr>
                <td  class="table-success">{{$mark->standard->norm->field->name}}</td>
                <td >{{$mark->standard->norm->norm}}</td>
                <td >{{$mark->standard->standard}}</td>
                <td >{{$mark->standard->mark}}</td>
                @php
                    $standards_ids[$mark->question_id]=$mark->standard_id;
                @endphp

              </tr>
              @endforeach

              <tr>
                <td colspan="3" ></td>
                <td class="final-result">المجموع النهائي =  {{$user->user_mark}}</td>
              </tr>
            </tbody>
          </table>

        </div>

      </div>
      <div class="result-table">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th> المجال</th>
                <th>المجموع الكلي   </th>
                <th>النسبة    </th>
                <th>المستوى    </th>


              </tr>

            </thead>
            <tbody>
                @foreach ($fields as $field)
                <tr>
                    <td class="table-success"><a href="exam-result.html">{{$field->name}}</a> </td>
                    <td >{{$mark=$user->getMarkField($field->id)}}</td>
                    <td >{{(int)(($mark/$field->count_standards)*100)}}%</td>
                    @php
                    $levelview='مستوى القيادة المنجزة';

                    @endphp

                    @if($user_mark >= 30 && $user->mark < 67)
                        @php
                              $levelview='مستوى القيادة المتقنة';
                        @endphp



                    @elseif($user->mark >=67)

                       @php
                           $levelview='مستوى القيادة المؤثرة';

                       @endphp
                        @endif


                    <td >{{$levelview}}</td>

                </tr>
                @endforeach


    <tfoot>
      <tr>
        <td class="table-warning total">
          المجموع الكلي لجميع المجالات
        </td>
        <td class="table-danger total">{{$user->user_mark}}</td>


        <td class="table-danger total">{{$user_mark}}%</td>



        <td class="table-danger total">{{$level}}</td>
      </tr>
    </tfoot>



            </tbody>
          </table>

        </div>


      </div>
      <hr>
      <div class="content answers-content">
        <div class="title">

          <h4> مراجعة أسئلة المقياس</h4>
        </div>
        <div class="questions-part">
            @foreach ($questions as $question)


            <div class="onequestions">

              <p>{{$question->question}}</p>
              @if ($question->photo)

                 <img src="/{{$question->photo}}" alt="">
              @endif
              <div class="answers">
                @foreach ($question->norm->standards as $standard)


                <div class="one-answer">
                  <input disabled {{ $standards_ids[$question->id]==$standard->id? 'checked':'' }} type="radio" name="questions[{{$question->id}}][{{$question->norm->id}}]" value="{{$standard->id}}"><label for="">{{$standard->standard}}</label>
                </div>
                @endforeach



              </div>

            </div>

            @endforeach

            <div class="contact-us text-center">
            <a href="{{route('welcome')}}" style="padding: 10px 30px">الخروج</a>

         </div>
        </div>
      </div>

    </div>
  </div>










            <script src="{{asset('/assets/js/jquery-3.3.1.min.js')}}"></script>
            <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/js/all.min.js')}}"></script>







</body>
</html>
