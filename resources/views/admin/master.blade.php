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
    <div class="wrapper">
        <div class="body-overlay"></div>




                <!-- Sidebar  -->
                <nav id="sidebar">
                  <div class="image-side">
                    <img src="{{asset('assets/img/2.png')}}" alt="">
                   </div>
                   <ul class="list-unstyled components">
                      <li class="dropdown">
                        <a href="#homeSubmenu1" data-bs-toggle="collapse"  type="button" aria-expanded="false" class="dropdown-toggle">
                          <i class="fa-solid fa-window-maximize"></i>
                        <span> المجالات</span></a>
                        <ul class="collapse list-unstyled menu" aria-labelledby="homeSubmenu1" id="homeSubmenu1">
                            <li>
                            <a href="{{route('admin.fields.index')}}">جميع المجالات </a>
                            </li>
                        </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#homeSubmenu2" data-bs-toggle="collapse"  type="button" aria-expanded="false" class="dropdown-toggle">
                              <i class="fa-regular fa-newspaper"></i>
                              <span>المعايير </span></a>
                              <ul class="collapse list-unstyled menu" aria-labelledby="homeSubmenu2" id="homeSubmenu2">
                              <li>
                                  <a href="{{route('admin.norms.index')}}">عرض جميع المعايير</a>
                              </li>
                              </ul>
                          </li>
                          <li class="dropdown">

                            <a href="#homeSubmenu3" data-bs-toggle="collapse"  type="button" aria-expanded="false" class="dropdown-toggle">
                              <i class="fa-solid fa-clipboard-question"></i>
                              <span> الأسئلة </span></a>
                            <ul class="collapse list-unstyled menu" aria-labelledby="homeSubmenu3" id="homeSubmenu3">
                             <li>
                              <a href="{{route('admin.questions.index')}}">عرض الأسئلة</a>
                             </li>
                           </ul>
                            </li>
                              <li class="dropdown">

                                <a href="#homeSubmenu5" data-bs-toggle="collapse"  type="button" aria-expanded="false" class="dropdown-toggle">
                                  <i class="fa-solid fa-database"></i>
                                  <span> النتائج </span></a>
                                <ul class="collapse list-unstyled menu" aria-labelledby="homeSubmenu5" id="homeSubmenu5">
                                  <li>
                                      <a href="{{route('admin.result.all')}}"> النتائج</a>
                                  </li>
                                  <li>
                                    <a href="{{route('admin.result.users')}}"> تحليل النتائج</a>
                                </li>

                                    </ul>
                                </li>

                                 <li class="">
                                      <a href="#"><i class="fas fa-sign-out-alt"></i><span>تسجيل الخروج</span></a>
                                  </li>

                              </ul>

               </nav>



                    <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-ellipsis-v"></i>
                    </button>


                <div class="content">
                    <div class="header nav">
                      <!-- BreadCrumb -->
                      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">{{getAuthspecialization("specialization")}}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">@yield('title-breadcrumb')</li>
                          @yield('breadcrumb')
                        </ol>
                      </nav>
                      <!-- BreadCrumb -->
                        <div class="logo main-logo">
                            <img src="{{asset('assets/img/1920px-MOELogo.svg.png')}}" alt="">
                        </div>

                    </div>
                    @if (Session::has('success') || Session::has('faild') ||  Session::has('warning') )

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

                       @endif
                    @yield('content')

                </div>






                </div>
            </div>
            <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
            <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/js/all.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
                  $('#sidebarCollapse').on('click', function () {
                      $('#sidebar').toggleClass('active');
                      // $('#content').toggleClass('active');
                  });

                   $('.more-button,.body-overlay').on('click', function () {
                      $('#sidebar,.body-overlay').toggleClass('show-nav');
                  });

              });






      </script>

     @stack('scripts')



</body>
</html>
