@extends('layouts.main')


@section('content')
    <div id="app">
        <edit-user :user="{{ $user }}" ></edit-user>
    </div>
@endsection