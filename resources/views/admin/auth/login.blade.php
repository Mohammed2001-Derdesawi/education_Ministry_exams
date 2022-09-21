@extends('admin.auth.master')
@section('title','صفحة تسجيل الدخول')
 @section('content')


            <form action="{{route('admin.login')}}" class="login" method="POST">
                @csrf
                <img src="{{asset('assets/img/237168f0-bca7-4ba4-b7e6-8709c7e861f9.jfif')}}" alt="">
                <h5>أهلا وسهلا بك</h5>
                <span>يرجى إدخال بياناتك</span>
                <br>

                <input type="email" name="email" placeholder=" البريد الإلكتروني" class="inp1">

                <span class="text-danger" style="padding-bottom: 10px;">
                    {{$errors->first("email")}}

                </span>

               <input type="password" name="password" placeholder="أدخل كلمة المرور" class="inp1">

               <span class="text-danger"  style="padding-bottom: 10px;">
                {{$errors->first("password")}}

            </span>
                <button type="submit">الدخول</button>
                <div class="contact">
                    <a href="{{route('admin.register.page')}}" style="color: #08B7A8">لا تملك حسابا؟ تسجيل الدخول</a>
            </div>
                <div class="contact">
                        <span>إدارة الإشراف التربوي</span>
                </div>
            </form>
            @endsection
