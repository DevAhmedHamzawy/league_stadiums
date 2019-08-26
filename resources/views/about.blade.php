@extends('layouts.main')

@section('content')


<!--start pages-header
             ================-->
             <section class="pages-header  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pages-title">
                            <h1 class="wow fadeInUp">من نحن</h1>
                            <p class="white-prg wow fadeInUp">موقع دورى الملاعب هو موقع مختص بتنظيم لعب الكورة بين الملاعب اللى موجودة</p>
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end pages-header-->
        
        
        
            <!--start about-pg
                     ================-->
            <section class="about-pg text-center marg-sec">
                <div class="container">
                    <div class="row">
                        <!--start why_us_text_grid-->
                        <div class="col-lg-4 col-sm-6 why_us_text_grid">
                            <div class="why_us_text_item wow fadeIn" data-wow-delay="0s">
                                <a href="#">
                                    <img src="{{ asset('public/images/icons/4.png') }}" alt="img" />
                                    <div class="side-why-us">
                                        <h4 data-cont="التسجيل وتحديد اللوكيشن الخاص بك">التسجيل وتحديد اللوكيشن الخاص بك </h4>
                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى
                                            المقروء لصفحة ما سيلهي القارئ عن التركيز على
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end why_us_text_grid-->
        
        
                        <!--start why_us_text_grid-->
                        <div class="col-lg-4 col-sm-6 why_us_text_grid">
                            <div class="why_us_text_item wow fadeIn" data-wow-delay=".3s">
                                <a href="#">
                                    <img src="{{ asset('public/images/icons/5.png') }}" alt="img" />
                                    <div class="side-why-us">
                                        <h4 data-cont="تحديد الملعب وملئ ابلكيشن الحجز ">تحديد الملعب وملئ ابلكيشن الحجز </h4>
                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى
                                            المقروء لصفحة ما سيلهي القارئ عن التركيز على
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end why_us_text_grid-->
        
        
                        <!--start why_us_text_grid-->
                        <div class="col-lg-4 col-sm-6 why_us_text_grid">
                            <div class="why_us_text_item wow fadeIn" data-wow-delay=".6s">
                                <a href="#">
                                    <img src="{{ asset('public/images/icons/6.png') }}" alt="img" />
                                    <div class="side-why-us">
                                        <h4 data-cont="تواصل مع ادارة الملعب لتأكيد الحجز"> تواصل مع ادارة الملعب لتأكيد الحجز </h4>
                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى
                                            المقروء لصفحة ما سيلهي القارئ عن التركيز على
                                        </p>
                                    </div>
                                </a>
                            </div>
        
                        </div>
                        <!--end why_us_text_grid-->
        
                    </div>
                </div>
            </section>
            
            <!--start why_us
             ================-->
            <section class="why_us marg-sec why-us_about gray_bg">
                <div class="container">
                    <div class="row">
                        <!--start why_us_text_grid-->
                        <div class="col-lg-6 why_us_text_grid">
                            <h3 class="green-title wow fadeIn"><i class="fa fa-warning"></i> نبذة وتعريف </h3>

                            <p class="wow fadeIn">
                                {{ $settings->about }}
                            </p>
                        </div>
                        <!--end why_us_text_grid-->

                        <div class="col-lg-6 why_us_caro_grid  wow fadeIn">
                            <div id="owl-demo" class="owl-carousel owl-theme second-owl">

                                <!-- start owl-item -->
                                <div class="item">
                                    <div class="why-img full-width-img">
                                        <img src="{{ asset('public/images/carousel/1.png') }}" alt="slider" class="converted-img" />
                                    </div>
                                </div>
                                <!-- end owl-item -->

                                <!-- start owl-item -->
                                <div class="item">
                                    <div class="why-img full-width-img">
                                        <img src="{{ asset('public/images/slider/1.png') }}" alt="slider" class="converted-img" />
                                    </div>
                                </div>
                                <!-- end owl-item -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end why_us -->
            <!--end about-pg -->

@endsection