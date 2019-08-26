@extends('layouts.main')

@section('content')
 <!--start register-pg-->
 <section class="login-pg marg-sec">
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger col-12 col-lg-6 col-md-6 wow fadeIn">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-6 wow fadeIn">
                <h3 class="login-title"><i class="fa fa-user"></i> للتسجيل يرجي ملئ حقول البيانات </h3>
                <form method="POST" action="{{ route('register') }}" class="needs-validation icons-form row" novalidate>
                    @csrf
                    <div class="form-group  col-12">
                        <i class="fa fa-user main-form-icon"></i>
                        <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="اسمك الكريم" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل إسم صحيح
                        </div>
                    </div>

                     <div class="form-group  col-12 wow fadeIn">
                        <i class="fa fa-calendar main-form-icon"></i>
                        <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" id="date" minlength="10" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل تاريخ الميلاد 
                        </div>
                    </div>

                    <div class="form-group  col-12 wow fadeIn">
                        <i class="fa fa-phone main-form-icon"></i>
                        <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" id="phone" minlength="10" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل رقم الموبايل
                        </div>
                    </div>

                    <div class="form-group  col-12">
                        <i class="fa fa-envelope main-form-icon"></i>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل بريد إلكتروني صحيح
                        </div>
                    </div>

                    <div class="form-group  col-12">
                        <i class="fa fa-map-marker main-form-icon"></i>
                        <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="المدينة" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل المدينة 
                        </div>
                    </div>

                    <div class="form-group  col-12">
                        <i class="fa fa-lock main-form-icon"></i>
                        <input type="password" class="form-control" name="password" placeholder="الرقم السري" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل رقم سري صحيح
                        </div>
                    </div>


                    <div class="form-group  col-12">
                        <i class="fa fa-lock main-form-icon"></i>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="تأكيد الرقم السري" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل تأكيد رقم سري صحيح
                        </div>
                    </div>



                    <div class="form-group  full-width-btn text-center submit-form-group col-12">
                        <button type="submit" class="custom_btn" data-hover="تسجيل "><span class="btn_text">تسجيل </span></button>
                    </div>

                    <div class="form-group col-12 forget-form-group">
                        <a href="{{ route('login') }}" class="register-link">مسجل بالفعل ؟</a>
                    </div>
                    

                </form>
            </div>

            <div class="col-lg-6 col-md-6 wow fadeIn">
                <div class="user-conditions" id="scroll-div">
                    <h3 class="login-title"><i class="fa fa-warning"></i> شروط الإستخدام </h3>

                    <p>
                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ،هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها ، هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
<!--end register-pg  -->
@endsection
