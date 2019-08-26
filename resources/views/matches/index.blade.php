@extends('layouts.main')


@section('content')
<section class="pages-header  text-center wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-12 pages-title">
                <h1 class="wow fadeInUp">المباريات</h1>
                <p class="white-prg wow fadeInUp">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على</p>

            </div>
        </div>
    </div>
</section>

 
<div id="app">
<matches></matches>
</div>


@endsection