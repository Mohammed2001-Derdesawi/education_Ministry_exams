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



    <form action="{{route('admin.result.user.rating',$user)}}" method="post">
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
                  <input type="radio" name="questions[{{$question->id}}]" value="{{$standard->mark}}"><label for="">{{$standard->standard}}</label>
                </div>
                @endforeach



              </div>

            </div>

            @endforeach

          </div>
         <button type="submit" class="btn-submit">إعادة تقييم</button>
    </form>


  </div>
</div>









                </div>
            </div>
            <script src="{{asset('/assets/js/jquery-3.3.1.min.js')}}"></script>
            <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/js/all.min.js')}}"></script>







</body>
</html>
