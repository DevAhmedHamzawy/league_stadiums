@extends('layouts.main')

@section('content')
    <div id="app">
        @if(Auth::user())
        <stadium :id="{{ $id }}" :user_id={{ Auth::user()->id }}></stadium>
        <comments stadium_id={{ $id }}></comments>
        <comment stadium_id={{ $id }}></comment>
        @else
        <stadium :id="{{ $id }}"></stadium>
        <comments stadium_id={{ $id }}></comments>
        <comment stadium_id={{ $id }}></comment>
        @endif
    </div>
@endsection