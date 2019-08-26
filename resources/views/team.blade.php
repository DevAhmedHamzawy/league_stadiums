@extends('layouts.main')


@section('content')
    <div id="app">
        <team :id={{ $id }}></team>
    </div>
@endsection