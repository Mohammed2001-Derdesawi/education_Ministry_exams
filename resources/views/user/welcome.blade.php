<!DOCTYPE html>
<html lang="ar" dir="rtl">
    @php
        $title="وزارة التربية والتعليم| المقياس";
    @endphp
@include('user.layouts.head')

<body>
    @include('user.layouts.header')

    <div class="container">
        <div style="margin-top: 80px;display: flex;justify-content: center; align-items:center;">

            @if (Session::has('warning'))

            <div class="alert alert-warning text-center" role="alert">
               {{Session::get('warning')}}
              </div>

            @endif
           </div>
        <div class="maincontent ">
            <form action="{{route('user.exam.page')}}"  method="GET"  class="login">
                @csrf
                <img src="{{asset('assets/img/237168f0-bca7-4ba4-b7e6-8709c7e861f9.jfif')}}" alt="">
                <h5>أهلا وسهلا بك</h5>
                <span>يرجى إدخال بياناتك</span>
                <br>
                <input  name="name" type="text" placeholder="الاسم كاملا" class="inp1">
                <span class="text-danger" style="padding-bottom: 10px;">
                    {{$errors->first("name")}}

                </span>

                <select name="office" id="" class="inp1">
                 @foreach ($offices as $office)
                     <option value="{{$office->id}}">{{$office->name}}</option>
                 @endforeach



                </select>
                <span class="text-danger" style="padding-bottom: 10px;">
                    {{$errors->first("office")}}

                </span>
                <select name="specialization" id="" class="inp1">
                    <option value=""> اختر المسار </option>
                    @foreach ($specializations as $specialization)
                    <option value="{{$specialization->id}}">{{$specialization->specialization}}</option>
                @endforeach


                </select>
                <span class="text-danger" style="padding-bottom: 10px;">
                    {{$errors->first("specialization")}}

                </span>
                <button type="submit">ابدأ الاختبار</button>

                <div class="contact">


                        <span>إدارة الإشراف التربوي</span>



                </div>
            </form>
        </div>

    </div>









    <script src="{{asset('/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/all.min.js')}}"></script>


</body>
</html>
