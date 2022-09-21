@extends('admin.auth.master')
@section('title','صفحة تسجيل الدخول')
 @section('content')


            <form action="{{route('admin.register')}}" class="login" method="POST">
                @csrf
                <img src="{{asset('assets/img/237168f0-bca7-4ba4-b7e6-8709c7e861f9.jfif')}}" alt="">
                <h5>أهلا وسهلا بك</h5>
                <span>يرجى إدخال بياناتك</span>
                <br>
                <div  style="text-align: right;margin: 10px 0">
                    <label for="">التخصص</label>
                    <select name="specialization" id="" class="inp1">
                       @foreach ($specializations as $specialization)
                       <option value="{{$specialization->id}}">{{$specialization->specialization}}</option>

                       @endforeach
                    </select>
                    <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("specialization")}}

                    </span>
                </div>
                <div  style="text-align: right;margin: 10px 0">
                <label for="">نوع المستخدم</label>
                <select  id="" name="type" class="inp1" onchange="Show_Offices(event)">

                    <option value="office">مكتب تعليم</option>
                    <option value="manager" selected>مدير مكاتب التعليم</option>
                 </select>
                </div>

                 <div id="offices" style="display:none;text-align: right;margin: 10px 0">
                    <label for="">مكتب التعليم</label>
                    <select name="office" id="office" class="inp1">
                       @foreach ($offices as $office)
                       <option value="{{$office->id}}">{{$office->name}}</option>

                       @endforeach
                    </select>

                    <span class="text-danger" style="padding-bottom: 10px;">
                        {{$errors->first("office")}}

                    </span>
                 </div>

                <input type="email" name="email" placeholder=" البريد الإلكتروني" class="inp1">
                <span class="text-danger" style="padding-bottom: 10px;">
                    {{$errors->first("email")}}

                </span>
               <input type="password" name="password" placeholder="أدخل كلمة المرور" class="inp1">
               <span class="text-danger" style="padding-bottom: 10px;">
                {{$errors->first("password")}}

            </span>
               <input type="password" name="password_confirmation" placeholder="إعادة كلمة المرور" class="inp1">

                <button type="submit">التسجيل</button>
                <div class="contact">
                    <a href="{{route('admin.login.page')}}" style="color: #08B7A8"> تملك حسابا؟ الدخول</a>
            </div>
                <div class="contact">


                        <span>إدارة الإشراف التربوي</span>



                </div>
            </form>
            @endsection

            @push('scripts')
            <script>
                function Show_Offices(e)
                {
                  var office=document.getElementById('offices');

                  if(e.target.value=='office')
                  {

               office.style.display='';

                  }
                  else
                  office.style.display='none';




                }

          </script>

            @endpush
