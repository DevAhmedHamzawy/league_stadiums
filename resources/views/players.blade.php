@extends('layouts.main')


@section('content')

    <div id="app">
        <players user_id="{{ Auth::user()->id }}"></players>
    </div>

@endsection