@extends('layouts.main')

@section('content')
<section class="pages-header  text-center wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-12 pages-title">
                <h1 class="wow fadeInUp">إضافة دورى جديد</h1>
                <p class="white-prg wow fadeInUp">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على</p>

            </div>
        </div>
    </div>
</section>

<section class="login-pg marg-sec" id="app">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 wow fadeIn">
                <h3 class="login-title"><i class="fa fa-exclamation-circle"></i> يرجي ملئ الحقول بالكامل لظهور الدورى بكامل تفاصيله</h3>
                <add-league :user="{{ Auth::user() }}"></add-league>
            </div>
        </div>
    </div>
</section>

@endsection