@extends('admin.layouts.gen')


@section('content')

<div class="container-fluid" id="app">
                
        <div class="card">
                <h3 class="card-header">
                     <div class="col-md-12 text-center title">اللاعبين</div>
                 </h3>
                 <div class="card-body">
                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-12">
                                 <div id="app">
                                        <players :auth_user_id={{ Auth::user()->id }}></players>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

</div>

@endsection