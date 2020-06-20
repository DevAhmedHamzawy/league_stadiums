@extends('layouts.main')

@section('content')

 <!--start pages-header
             ================-->
             <section class="pages-header  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pages-title">
                            <h1 class="wow fadeInUp">تـــــأكـــــيــــــد الـــبــــريـــــد الإلـــكــــــتــــــرونـــــــــى</h1>
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
                        <div class="col-12 wow fadeIn text-center">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    تم إرسال كود التأكيد مرة أخرى للبريد الإلكترونى الخاص بك ..... الرجاء تفقد البريد الإلكترونى
                                </div>
                            @endif
    
                            <h1>من فضلك قم بتأكيد البريد الإلكترونى عبر كود التأكيد الذى تم إرساله إليك</h1>
                            <br/><br/>
                            <h2>إذا لم تستلم كود التأكيد, <a href="{{ route('verification.resend') }}">إضغط هنا لطلب كود اخر</a>.</h2>
                        </div>
                    </div>
                </div>
            </section>
            <!--end login-pg  -->

@endsection