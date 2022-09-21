<!DOCTYPE html>
<html lang="ar" dir="rtl">
    @php
        $title="أسئلة المقياس";
    @endphp
@include('user.layouts.head')
<body>

@include('user.layouts.header')
<div class="container">
  <div class="content content-exam">
    <div class="title">
      <img src="{{asset('assets/img/237168f0-bca7-4ba4-b7e6-8709c7e861f9.jfif')}}" alt="">
      <h4 class="standard-qu">أسئلة المقياس-{{$specialization}}</h4>
    </div>
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
     @if ($questions->count()>0)


    <form action="{{route('user.exam.calcuate')}}" method="post">
        @csrf
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
                  <input type="radio" name="questions[{{$question->id}}][{{$question->norm->id}}]" value="{{$standard->id}}"><label for="">{{$standard->standard}}</label>
                </div>
                @endforeach



              </div>

            </div>

            @endforeach

          </div>
         <button type="submit" class="btn-submit">إرسال</button>
    </form>
    @else
    <div style="margin-bottom: 80px">
        <p class="text-center">لا يوجد أسئلة مضافة لهذا المسار شكرا لك</p>
        <div class="contact-us text-center">
            <a href="{{route('welcome')}}" style="padding: 10px 30px">الخروج</a>

         </div>
    </div>

    @endif

  </div>
</div>









                </div>
            </div>
            <script src="{{asset('/assets/js/jquery-3.3.1.min.js')}}"></script>
            <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/js/all.min.js')}}"></script>







</body>
</html>
