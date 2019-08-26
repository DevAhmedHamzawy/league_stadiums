@extends('layouts.main')


@section('content')
    <div id="app">
        <profile :id={{ $id }}></profile>
    </div>
@endsection