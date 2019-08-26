<!DOCTYPE html>
<!--
  To change this license header, choose License Headers in Project Properties.
  To change this template file, choose Tools | Templates

  and open the template in the editor.
-->
<html>

<head>
    <title>dawry elmla3b</title>
    <!--
      Meta tags
      ================
    -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>
   
    <!--
      Style sheet
      ================
    -->

   
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}" type="text/css" />
    <!--arabic-style only-->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-rtl.min.css') }}" type="text/css" />
    <!--end-->
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/owl.theme.default.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/imageuploadify.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/header.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/footer.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/keyframes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}" type="text/css" />
    <!--arabic-style only-->
    <link rel="stylesheet" href="{{ asset('public/css/ar.css') }}" type="text/css" />
    <!--english-style only<link rel="stylesheet" href="css/en.css" type="text/css" />--end-->
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}" type="text/css" />


</head>

<body>


    <!--start header
             ================-->
    <header>
        <div class="container">
            <div class="row">
                <!--start logo-grid-->
                <div class="col-xl-2 col-md-6 logo-grid">
                    <div class="nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('public/images/main/logo.png') }}" alt="logo"></a>
                </div>
                <!--end logo-grid-->

                <!--start main-nav-grid-->
                <div class="col-xl-7 main-nav-grid">

                    <nav>
                        <div class="responsive-div">
                            <a href="{{ url('/') }}" class="res-logo wow fadeIn"><img src="{{ asset('public/images/main/logo.png') }}" alt="logo"></a>
                            <!--start search-form-->
                            <div class="responsive-search">
                                <form class="needs-validation" novalidate>
                                    <div class="search-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="بحث..." required />
                                            <div class="invalid-feedback">
                                                من فضلك أدخل كلمات بحث صحيحة
                                            </div>
                                            <button type="submit" class="form-btn"><i class="fa fa-search"></i></button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end search-form-->

                        </div>
                        <ul>
                            <li class="active">
                                <a href="{{ url('/about') }}">من نحن </a>
                            </li>
                            <li class="menu-item-has-child" tab-index="0">
                                <a href="{{ url('/the_leagues') }}">الدوريات</a>
                                
                            </li>
                            <li class="menu-item-has-child" tab-index="0">
                                <a href="{{ url('/the_stadiums') }}">الملاعب المتاحه</a>
                               
                            </li>

                            <li tab-index="0">
                                <a href="{{ url('/conditions') }}">الشروط والاحكام </a>
                            </li>

                          
                            <li tab-index="0">
                                <a href="{{ url('/contact') }}">اتصل بنا</a>
                            </li>


                        </ul>
                    </nav>
                </div>
                <!--end main-nav-grid-->

                <!--start login-grid-->
                <div class="col-xl-3 col-md-6 login-grid">                       
                       
                        @if(Auth::user())
                            <a href="{{route('updateProfile', ['id' => Auth::user()->id ])}}" class="lang-link">تعديل البيانات</a>
                            @if(Auth::user()->hasRole('team_owner'))
                            <a href="{{ url('/players') }}" class="lang-link">اللاعبين</a>
                            <a href="{{ url('/team/'.Auth::user()->id) }}" class="lang-link">فريقك</a>
                            @elseif(Auth::user()->hasRole('stadium_owner'))
                            <a href="{{ url('/stadiums') }}" class="lang-link">الملاعب الخاصة بيك</a>
                            <a href="{{ url('/leagues') }}" class="lang-link">الدوريات الخاصة بيك</a>
                            @elseif(Auth::user()->hasRole('refree'))
                            <a href="{{ url('/matches') }}" class="lang-link">إضافة نتيجة لمباراه</a>
                            @endif
                            <a href="{{ route('logout') }}" class="custom_btn dark_btn" data-hover="تسجيل الخروج" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="btn_text"><i class="fa fa-user"></i>{{ Auth::user()->user_name }}</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ url('login') }}" class="custom_btn dark_btn" data-hover="تسجيل دخول"><span class="btn_text"><i class="fa fa-user"></i>دخول الأعضاء</span></a>
                        @endif


                </div>
                <!--end login-grid-->

            </div>
        </div>
    </header>

    <!--end header-->



    @yield('content')

 

    <!--start footer
          ================-->

    <footer>
        <div class="container">
            <div class="row">

                <!--start footer-description-->
                <div class="col-xl-3 col-md-6  col-sm-12  footer-description wow fadeIn">
                    <h2 class="sec-title">نبذه عنا</h2>
                    <p class="dark-prg">هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. </p>

                    <div class="social-btns">
                        <a class="snapchat" href="#" target="_blank"><i class="fa fa-snapchat"></i></a>
                        <a class="instagram" href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a class="youtube" href="#" target="_blank"><i class="fa fa-youtube-play"></i></a>
                        <a class="twitter" href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a class="facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    </div>

                </div>
                <!--end footer-lists-->


                <!--start footer-lists-->
                <div class="col-xl-6 col-md-12  col-sm-12 footer-lists-grid">
                    <div class="footer-lists row">
                        <!--start single-footer-list-->
                        <div class="single-footer-list col-sm-4 col-6  wow fadeIn">
                            <h2 class="sec-title">خريطة الموقع</h2>
                            <ul class="list-unstyled">
                                <li><a href="#"> من نحن </a></li>
                                <li><a href="#"> الدوريات </a></li>
                                <li><a href="#">الملاعب المتاحه </a></li>
                                <li><a href="#"> الشروط والاحكام </a></li>
                                <li><a href="#"> 404 خطأ الصفحة </a></li>
                            </ul>
                        </div>
                        <!--end  single-footer-list-->
                        <!--start single-footer-list-->
                        <div class="single-footer-list col-sm-4 col-6  wow fadeIn">
                            <h2 class="sec-title">خريطة الموقع</h2>
                            <ul class="list-unstyled">
                                <li><a href="#"> من نحن </a></li>
                                <li><a href="#"> الدوريات </a></li>
                                <li><a href="#">الملاعب المتاحه </a></li>
                                <li><a href="#"> الشروط والاحكام </a></li>
                                <li><a href="#"> 404 خطأ الصفحة </a></li>
                            </ul>
                        </div>
                        <!--end  single-footer-list-->


                        <!--start single-footer-list-->
                        <div class="single-footer-list col-sm-4 col-6  wow fadeIn">
                            <h2 class="sec-title">خريطة الموقع</h2>
                            <ul class="list-unstyled">
                                <li><a href="#"> من نحن </a></li>
                                <li><a href="#"> الدوريات </a></li>
                                <li><a href="#">الملاعب المتاحه </a></li>
                                <li><a href="#"> الشروط والاحكام </a></li>
                                <li><a href="#"> 404 خطأ الصفحة </a></li>
                            </ul>
                        </div>
                        <!--end  single-footer-list-->


                    </div>

                </div>
                <!--end footer-lists-->


                <!--start footer-social-->
                <div class="col-xl-3 col-md-6  col-sm-12  footer-subscripe wow fadeIn">
                    <h2 class="sec-title">القائمة البريدية</h2>
                    <form method="post" action="{{route('newsletter')}}">
                    @csrf
                        <div class="subscripe">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="ضع ايميلك هنا .." />
                            </div>

                            <div class="form-group">
                                <button type="submit" class="custom_btn subscripe-btn" data-hover="اشتــــــرك"><span class="btn_text">اشتــــــرك</span></a>
                        </div>
                    </form>
     
                    </div>


                </div>
                <!--end footer-lists-->
            </div>
        </div>
    </footer>
    <!--end footer-->

    <!--start copyrights-->
    <div class="copyrights text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    &copy جميع الحقوق محفوظة لموقع دورى الملاعب 2019
                </div>

            </div>
        </div>
    </div>
    <!--end copyrights-->



    <!--Scripts
         ================-->

   
         <script src="{{ asset('public/js/app.js') }}" type="text/javascript"></script>
         <script type="text/javascript" src="{{ asset('public/js/html5shiv.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('public/js/respond.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('public/js/popper.min.js') }}"></script>
         <script src="{{ asset('public/js/owl.carousel.min.js') }}" type="text/javascript"></script>
         <script type="text/javascript" src="{{ asset('public/js/html5lightbox.js') }}"></script>
         <script src="{{ asset('public/js/imageuploadify.min.js') }}" type="text/javascript"></script>
         <script src="{{ asset('public/js/wow.min.js') }}" type="text/javascript"></script>
         <script src="{{ asset('public/js/custom.js') }}" type="text/javascript"></script>


</body>

</html>
