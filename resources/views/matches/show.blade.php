@extends('layouts.main')


@section('content')
<section class="pages-header  text-center wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-12 pages-title">
                <h1 class="wow fadeInUp">إ  مباراة</h1>
                <p class="white-prg wow fadeInUp">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على</p>

            </div>
        </div>
    </div>
</section>

 <!--start result-pg
    ================-->
<section class="result-pg marg-sec">
<div class="container">
<div class="row" id="app">
<match match_id={{ $id }}></match>
<comments match_id={{ $id }}></comments>
<comment match_id={{ $id }}></comment>
</div>
</div>
</section>
<!--end result-pg  -->

@endsection