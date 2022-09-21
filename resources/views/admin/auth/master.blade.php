<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8" dir="rtl">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.rtl.min.css')}}">
        <!-- My Custom Style -->
        <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
            <!-- Font Awesome 5 -->
            <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
        <title>@yield('title')</title>
    </head>
<body>
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-dark ">
             <div class="brand">
                <a href="">
                    <img  class="logo" src="{{asset('assets/img/1920px-MOELogo.svg.png')}}" alt="">
                   </a>
             </div>
                <div class="link">
                    <p>
                        الإدارة العامة للتعليم بمحافظة جدة<br>
                        الشؤون التعليمية<br>
                        إدارة الإشراف التربوي
                    </p>

                  </div>
                <div class="contact-us">
                    <a href="#">   تواصل معنا</a>
                </div>
              </nav>

        </div>
    </div>
    <div class="container">
        <div style="margin-top: 80px;display: flex;justify-content: center; align-items:center;">
            @if (Session::has('success'))

            <div class="alert alert-info text-center" style="width: fit-content"  role="alert">
               {{Session::get('success')}}
              </div>

            @endif
            @if (Session::has('faild'))

            <div class="alert alert-faild text-center" style="width: fit-content"  role="alert">
               {{Session::get('faild')}}
              </div>

            @endif
            @if (Session::has('warning'))

            <div class="alert alert-warning text-center" role="alert">
               {{Session::get('warning')}}
              </div>

            @endif
           </div>
        <div class="maincontent">

          @yield('content')
        </div>

    </div>









    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/all.min.js')}}"></script>
    @stack('scripts')


</body>
</html>
