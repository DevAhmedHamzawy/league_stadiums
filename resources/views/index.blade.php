@extends('layouts.main')

@section('content')
   <!--start slider
             ================-->
             <section class="slider  wow fadeIn">
                <div class="container-fluid">
                    <div class="row">
                        <div id="owl-demo" class="owl-carousel owl-theme first-owl">
                            <!-- start owl-item -->
                            <div class="item">
                                <div class="slider-img full-width-img">
                                    <img src="{{ asset('public/images/slider/1.jpg') }}" alt="slider" class="converted-img" />
                                </div>
                                <div class="slider-caption  text-center">
                                    <h3 class="white-title">ضيف ملعبك</h3>
                                    <p class="white-prg">تقدر تضيف ملعبك هنا وكمان تضيف دورى خاص بالملعب فأى وقت عايزه</p>
                                    <a href="{{ route('register') }}" class="custom_btn" data-hover="سجل معانا"><span class="btn_text">عايز تضيف ملعب أو دورى</span></a>
                                </div>
                            </div>
                            <!-- end owl-item -->
        
                            <!-- start owl-item -->
                            <div class="item">
                                <div class="slider-img full-width-img">
                                    <img src="{{ asset('public/images/slider/2.jpg') }}" alt="slider" class="converted-img" />
                                </div>
                                <div class="slider-caption  text-center">
                                    <h3 class="white-title">عايز تعمل فريق</h3>
                                    <p class="white-prg">تقدر تعمل الفريق الخاص بيك وتشارك فأى دورى موجود فالموقع</p>
                                    <a href="{{ route('register') }}" class="custom_btn" data-hover="سجل معانا"><span class="btn_text">عايز تعمل فريق</span></a>
                                </div>
                            </div>
                            <!-- end owl-item -->
        
        
                            <!-- start owl-item -->
                            <div class="item">
                                <div class="slider-img full-width-img">
                                    <img src="{{ asset('public/images/slider/3.jpg') }}" alt="slider" class="converted-img" />
                                </div>
                                <div class="slider-caption  text-center">
                                    <h3 class="white-title">عايز تبقى حكم</h3>
                                    <p class="white-prg">تقدر تتفق مع صاحب الإستاد إنك تبقى حكم فى دورى او مباريات معينه فيه</p>
                                    <a href="{{ route('register') }}" class="custom_btn" data-hover="سجل معانا"><span class="btn_text">عايز تبقى حكم</span></a>
                                </div>
                            </div>
                            <!-- end owl-item -->
        
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end slider-->
        
        
        
            <!--start services
                     ================-->
            <section class="services  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <!--start service-grid-->
                        <div class="col-lg-4 service-grid">
                            <div class="service-div">
                                <img src="{{ asset('public/images/icons/1.png') }}" alt="service" />
                                <div class="side-serv">
                                    <h3 class="white-title">عايز تضيف ملعب !</h3>
                                    <p class="white-prg">تقدر تضيف الملعب وكمان الدوريات الخاصة بيك</p>
                                </div>
                            </div>
                        </div>
                        <!--end service-grid-->
        
                        <!--start service-grid-->
                        <div class="col-lg-4 service-grid">
                            <div class="service-div">
                                <img src="{{ asset('public/images/icons/2.png') }}" alt="service" />
                                <div class="side-serv">
                                    <h3 class="white-title">عايز تلعب ماتش ؟</h3>
                                    <p class="white-prg">تقدر تعمل فريق وتلعب بيه فأى من الدوريات الموجودة</p>
                                </div>
                            </div>
                        </div>
                        <!--end service-grid-->
        
                        <!--start service-grid-->
                        <div class="col-lg-4 service-grid">
                            <div class="service-div">
                                <img src="{{ asset('public/images/icons/3.png') }}" alt="service" />
                                <div class="side-serv">
                                    <h3 class="white-title">نفسك تبقى حكم !</h3>
                                    <p class="white-prg">تقدر بالاتفاق مع صاحب الملعب تشوف الدورى او المباريات اللى تقدر تحكم فيها</p>
                                </div>
                            </div>
                        </div>
                        <!--end service-grid-->
        
                    </div>
                </div>
            </section>
            <!--end services-->
        
        
            <!--start main-tables
                     ================-->
            <section class="main-tables  text-center">
                <div class="container">
                    <div class="row">
                        <!--start scroll-leagues-grid-->
                        <div class="col-lg-6 scroll-leagues-grid wow fadeIn">
                            <h3 class="green-title"><img src="{{ asset('public/images/icons/7.png') }}" alt="img" />  الدوريات اللى موجودة فالموقع </h3>
                            <div class="scroll-leagues-div">
                                <div class="scroll-leagues">
                    
                                    @foreach ($leagues as $league)
                                        <!--start league-item-->
                                        <div class="league-item">
                                            <a href="#">
                                                <img src="{{ asset('public/images/leagues/'.$league->image) }}" alt="img" />
                                                <h4>{{ $league->name }}</h4>
                                            </a>
                                        </div>
                                        <!--end league-item-->
                                    @endforeach
            
                                </div>
                            </div>
                        </div>
                        <!--end scroll-leagues-grid-->
        
                        <!--start latest matches-->
                        <div class="col-lg-6 latest matches-grid wow fadeIn">
                            <h3 class="green-title"><i class="fa fa-calendar"></i> المباريات الأخيرة </h3>
        
                            <div class="latest-matches">
                                <table class="table  table-bordered table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th scope="col">الدورى</th>
                                            <th scope="col">المرحلة</th>
                                            <th scope="col">الفريق الأول</th>
                                            <th scope="col">عدد الأهداف</th>
                                            <th scope="col">الفريق الثانى</th>
                                            <th scope="col">عدد الأهداف</th>
        
                                        </tr>
                                    </thead>
        
                                    <tbody>

                                        @foreach ($matches as $match)
                                            <tr>
                                                <td><a href="match.html">{{$match->league->name}}</a></td>
                                                <td>@if($match->type_id == null) {{ $match->group_id }} @else {{ $match->type_id }} @endif</td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if($user->id == $match->team1){{ $user->user_name }}@endif
                                                    @endforeach
                                                </td> 
                                                <td>{{ $match->statistics->goals_t1 ?? 0 }}</td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if($user->id == $match->team2){{ $user->user_name }}@endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $match->statistics->goals_t2 ?? 0 }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end latest matches-->
        
        
        
                    </div>
                </div>
            </section>
            <!--end main-tables-->
        
            <!--start why_us
                     ================-->
            <section class="why_us marg-sec gray_bg">
                <div class="container">
                    <div class="row">
                        <!--start why_us_text_grid-->
                        <div class="col-lg-6 why_us_text_grid">
                            <h3 class="green-title"><i class="fa fa-warning"></i> ليه دوري الملاعب ؟! </h3>
                            <div class="why_us_text_item wow fadeIn" data-wow-delay="0s">
                                <a href="#">
                                    <img src="{{ asset('public/images/icons/4.png') }}" alt="img" />
                                    <div class="side-why-us">
                                        <h4 data-cont="التسجيل وتحديد اللوكيشن الخاص بك">التسجيل وتحديد اللوكيشن الخاص بك </h4>
                                        <p>سجل ملعبك وحدد مكانه بالظبط واحنا نساعد الزوار فى الوصول ليه</p>
                                    </div>
                                </a>
                            </div>
        
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
                                        <img src="{{ asset('public/images/slider/1.jpg') }}" alt="slider" class="converted-img" />
                                    </div>
                                </div>
                                <!-- end owl-item -->
        
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end why_us -->
        
            <!--start availabe-staduim 
                     ================-->
            <section class="availabe-staduim marg-sec wow fadeIn">
                <div class="container">
                    <div class="row">
                        <h3 class="green-title left-title col-12"><i class="fa fa-futbol-o"></i> الملاعب المتاحه
                            <a href="staduims.html" class="green-span"> المزيد من الملاعب <i class="fa fa-long-arrow-left"></i></a> </h3>
        
                        <div id="owl-demo" class="owl-carousel owl-theme third-owl">
                            
                            @foreach ($stadiums as $stadium)
                                <!-- start owl-item -->
                                <div class="item">
                                    <div class="studim-div">
                                        <a href="{{ asset('public/images/stadiums/'.$stadium->image) }}" class="html5lightbox">
                                            <div class="studim-img static-st-img full-width-img">
                                                <img src="{{ asset('public/images/stadiums/'.$stadium->image) }}" alt="slider" class="converted-img" />
                                            </div>
            
                                            <div class="studim-img transform-img full-width-img">
                                                <img src="{{ asset('public/images/stadiums/'.$stadium->image) }}" alt="slider" class="converted-img" />
                                            </div>
                                        </a>
                                        <h3>اسم الملعب</h3>
                                        <ul class="list-inline studim-list">
                                            <li><a href="#"><i class="fa fa-map-marker"></i>{{ $stadium->name }}</a></li>
                                            <li><a href="#"><i class="fa fa-phone"></i>{{ $stadium->telephone }}</a></li>
                                            <li><a href="#"><i class="fa fa-plus-circle"></i>للحجز</a></li>
                                        </ul>
                                        <p class="dark-prg">
                                            {{ $stadium->address }}
                                        </p>
                                        <div class="text-center">
                                            <a href="{{ url('stadium/'.$stadium->id) }}" class="custom_btn" data-hover="مشاهدة الملعب"><span class="btn_text">مشاهدة الملعب</span></a>
                                        </div>
                                    </div>
            
                                </div>
                                <!-- end owl-item -->
                            @endforeach
                            
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end availabe-staduim  -->
        
        
            <!--start about-us
                     ================-->
            <section class="about-us text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12 about_pos  wow fadeIn">
                            <h3 class="green-title text-center"><i class="fa fa-futbol-o"></i>تكريم أفضل الملاعب والدوريات كل شهر</h3>
                            <p class="white-prg">كل شهر بنحدد أفضل (أفضل لاعبين - أفضل فرق - أفضل ملاعب- أفضل حكام ) وبيتم تكريمهم فالموقع وترشيحهم فنتائج البحث المتقدمة </p>
                        </div>
                    </div>
                </div>
            </section>
            <!--end about-us  -->
        
        
            <!--start join-us
                     ================-->
            {{--<section class="join-us marg-sec">
                <div class="container">
                    <div class="row">
                        <!--start join-team-grid-->
                        <div class="col-lg-6 join-team-grid">
                            <h3 class="green-title"><i class="fa fa-futbol-o"></i> انضم لفريق </h3>
                            <span class="arrow-prg"> هو ببساطة نص شكلي (بمعنى أن الغاية هي </span>
                            <ul class="list-inline search-list">
                                <li class="wow fadeIn" data-wow-delay=".2s"><a href="#">الفريق</a></li>
                                <li class="wow fadeIn" data-wow-delay=".4s"><a href="#">المدينة</a></li>
                                <li class="wow fadeIn" data-wow-delay=".6s"><a href="#">التقييم</a></li>
                                <li class="wow fadeIn" data-wow-delay=".8s"><a href="#">الملعب</a></li>
                                <li class="wow fadeIn" data-wow-delay="1s"><a href="#"><i class="fa fa-search"></i></a></li>
        
                            </ul>
                        </div>
                        <!--end join-team-grid-->
        
                        <!--start opinion-grid-->
                        <div class="col-lg-6 opinion-grid wow fadeIn">
                            <h3 class="green-title"><i class="fa fa-futbol-o"></i> اَراء العملاء </h3>
                            <div id="owl-demo" class="owl-carousel owl-theme four-owl">
        
                                <!-- start owl-item -->
                                <div class="item">
                                    <div class="opinion-div">
                                        <div class="circle-opn-img static-st-img full-width-img">
                                            <img src="{{ asset ('public/images/main/man.png') }}" alt="slider" class="converted-img" />
                                        </div>
                                        <div class="side-opinion">
                                            <h3>احمد عادل محمد </h3>
                                            <span class="opn-job">" مصمم ومطور برامج ادارة محتوي "</span>
                                            <p>
                                                <span>هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل</span>
                                                <a href="opinions.html" class="bordr_btn inline-border-btn">اقرء المزيد ...</a>
                                            </p>
        
                                        </div>
        
                                    </div>
                                </div>
                                <!-- end owl-item -->
        
                            </div>
                        </div>
                        <!--end opinion-grid-->
        
        
                    </div>
                </div>
            </section>--}}
            <!--end join-us  -->
        
            <!--start news
                     ================-->
            <section class="news marg-sec  gray_bg  wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="green-title text-center"><i class="fa fa-futbol-o"></i> احدث الاخبار </h3>
        
                            <div id="owl-demo" class="owl-carousel owl-theme five-owl">
        
                                
                                @foreach ($articles as $article)
                                    <!-- start owl-item -->
                                    <div class="item">
                                        <div class="opinion-div news-div">
                                            <div class="circle-opn-img static-st-img full-width-img">
                                                <img src="{{ asset ('public/images/news/1.png') }}" alt="slider" class="converted-img" />
                                            </div>
                                            <div class="side-opinion">
                                                <h3>{{ $article->title }}</h3>
                                                <p>
                                                    <span>
                                                        {{ $article->description }}
                                                    </span>
                                                    <a href="{{ url('article/'.$article->id) }}" class="bordr_btn inline-border-btn orange_btn">اقرء المزيد ...</a>
                                                </p>
            
                                            </div>
            
                                        </div>
                                    </div>
                                    <!-- end owl-item -->    
                                @endforeach
                              
        
        
                            </div>
        
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end news -->
@endsection