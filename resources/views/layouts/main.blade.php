<!DOCTYPE html>
<html lang="en">
@include('partials.header')


<body class="with-top-navbar background">


@include('partials.navbar')
@yield('profile')
@yield('posts')
@yield('sidebar')
@include('partials.footer')