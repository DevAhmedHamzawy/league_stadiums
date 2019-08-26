@extends('layouts.main')


@section('content')

    <div id="app">
        @if(Auth::user())
        <league :id="{{ $id }}" :user_id={{ Auth::user()->id }}></league>
        <comments league_id={{ $id }}></comments>
        <comment league_id={{ $id }}></comment>
        @else
        <league :id="{{ $id }}"></league>
        <comments league_id={{ $id }}></comments>
        <comment league_id={{ $id }}></comment>
        @endif
    </div>

@endsection