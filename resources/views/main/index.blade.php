@extends('layouts.main')
<div class="container p-t-md">
    <div class="row">
@section('profile')
    @include('main.profile')
    @endsection
@section('posts')
    @include('main.post')
    @endsection
@section('sidebar')
    @include('main.sidebar')
    @endsection
    </div>
</div>