@extends('layouts.main')

@section('content')

 <!--start login-pg-->
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
            <div class="col-lg-6 col-md-8 wow fadeIn">
                <h3 class="login-title"><i class="fa fa-user"></i> تسجيل دخول </h3>
                <form  method="POST" action="{{ route('login') }}" class="needs-validation icons-form row" novalidate>
                    @csrf
                    <div class="form-group  col-12">
                        <i class="fa fa-user main-form-icon"></i>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="البريد الإلكترونى" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل البريد الإلكترونى 
                        </div>
                    </div>



                    <div class="form-group  col-12">
                        <i class="fa fa-lock main-form-icon"></i>
                        <input type="password" class="form-control" name="password" placeholder="الرقم السري" required>
                        <div class="invalid-feedback">
                            من فضلك أدخل رقم سري صحيح
                        </div>
                    </div>

                    <div class="form-group col-4 condition-form-group wow fadeIn">
                        <input type="checkbox" id="customRadioInline2" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                        <label class="custom-control-label"  for="customRadioInline2">تذكرني</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="form-group col-8 forget-form-group">
                            {{--<a href="{{ route('password.request') }}" class="forget-link">هل نسيت الرقم السري؟</a>--}}
                        </div>
                    @endif


                    <div class="form-group  full-width-btn text-center submit-form-group col-12">
                        <button type="submit" class="custom_btn" data-hover="تسجيل دخول"><span class="btn_text">تسجيل دخول</span></button>
                    </div>

                    <div class="form-group col-12 forget-form-group">
                        <a href="{{ route('register') }}" class="register-link">ليس لديك حساب؟</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</section>
<!--end login-pg-->

@endsection
