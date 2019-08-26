@extends('admin.layouts.gen')


@section('content')

<div class="container-fluid" id="app">
                

        <users :auth_user_id={{ Auth::user()->id }}></users>


</div>

@endsection