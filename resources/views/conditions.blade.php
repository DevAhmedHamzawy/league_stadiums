@extends('layouts.main')

@section('content')

 <!--start pages-header
             ================-->
             <section class="pages-header  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pages-title">
                            <h1 class="wow fadeInUp">الشروط والاحكام</h1>
                            <p class="white-prg wow fadeInUp">شروط إستخدام الموقع</p>
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end pages-header-->
        
        
        
            <!--start login-pg
                     ================-->
            <section class="login-pg marg-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-12 wow fadeIn">
                            <div class="arrow-list">
                                <ul class="list-unstyled">
                                    <li>
                                        {{ $settings->conditions }}
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group  condition-form-group wow fadeIn">
                                <input type="checkbox" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label bold-label" for="customRadioInline2">لقد قرءت الشروط واوافق عليها بالكامل واتعهد بعدم الاخلال باى شرط بهم</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end login-pg  -->

@endsection