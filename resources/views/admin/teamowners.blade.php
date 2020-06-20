@extends('admin.layouts.gen')


@section('content')

<div class="container-fluid" id="app">
                
        <div class="card">
                <h5 class="card-header">
                     <div class="col-md-12 text-center title">أصــحــاب الــفــرق</div>
                 </h5>
                 <div class="card-body">
                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-12">
                                 <div id="app">
                                        <teamowners :auth_user_id={{ Auth::user()->id }}></teamowners>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

</div>

@endsection