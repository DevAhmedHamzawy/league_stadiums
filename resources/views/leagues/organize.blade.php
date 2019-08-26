@extends('layouts.main')


@section('content')

    <div id="app">
        <organize-league :id="{{ $id }}"></organize-league>
    </div>

@endsection