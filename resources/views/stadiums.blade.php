@extends('layouts.main')

@section('content')

<!--start pages-header
             ================-->
             <section class="pages-header  text-center wow fadeIn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pages-title">
                            <h1 class="wow fadeInUp">الملاعب المتاحة</h1>        
                        </div>
                    </div>
                </div>
            </section>
            <!--end pages-header-->
    <div id="app">
        @if(Auth::user())
            <stadiums id="{{ Auth::user()->id }}"></stadiums>
        @else
            <stadiums></stadiums>
        @endif
    </div>

@endsection