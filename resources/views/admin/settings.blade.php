@extends('admin.layouts.gen')


@section('content')

<div class="container-fluid">
                
    <div class="row">

        <settings :auth_user_id={{ Auth::user()->id }}></settings>

    </div>

</div>

@endsection