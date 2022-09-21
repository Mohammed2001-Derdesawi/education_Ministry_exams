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
                @if (!Route::is('admin.result.user.rating.page'))
                <a href="#">   تواصل معنا</a>

                @endif

            </div>
          </nav>

    </div>
</div>
