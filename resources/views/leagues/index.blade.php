@extends('layouts.main')

@section('content')

<!--start pages-header
             ================-->
             <section class="pages-header  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pages-title">
                            <h1 class="wow fadeInUp">الدوريات الخاصة بيك</h1>
                            <a href="{{ url('/leagues/create') }}" class="custom_btn white-prg wow fadeInUp" data-hover="اضغط هنا"><span class="btn_text">هتضيف دوري</span></a>
        
                        </div>
                    </div>
                </div>
            </section>
            <!--end pages-header-->
    <div id="app">
        <owner-leagues id="{{ Auth::user()->id }}"></owner-leagues>
    </div>

@endsection