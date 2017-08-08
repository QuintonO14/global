@extends('layouts.main')
<div class="container p-t-md">
    <div class="row">
        @section('profile')
            @include('profile.profile')
        @endsection
        @section('posts')
            @include('profile.post')
        @endsection
        @section('sidebar')
            @include('profile.sidebar')
        @endsection
    </div>
</div>