<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" style="overflow: hidden;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Global</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/toolkit.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/application.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body style="background: black;">
<div class="container" style="
        border-radius: 100%;
        height: 1000px;
        width: 1000px;
        background-image: url('{{'images/earthbackground.jpg'}}');
        background-size: contain;
        margin-top: -150px;">
        <div class="registerForm">
            <h3 class="text-center">Register Here!</h3>
            {!! Form::open(['method'=>'POST', 'route'=>'register']) !!}
            {!! Form::label('firstname', 'First Name:') !!}
            {!! Form::text('firstname', null, ['class'=>'form-control']) !!}
            {!! Form::label('lastname', 'Last Name:') !!}
            {!! Form::text('lastname', null, ['class'=>'form-control']) !!}
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class'=>'form-control']) !!}
            {!! Form::label('password', 'Create Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
            {!! Form::label('password-confirm', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
            {!! Form::label('country_living', 'Where do you live?') !!}
            <select name="country_living" id="" class="form-control">
                <option value="">Select A Location</option>
                @foreach($countries as $country)
                <option value="{{$country}}" class="form-control">{{$country}}</option>
                @endforeach
            </select>
            {!! Form::label('gender', 'Gender:') !!}
            {!! Form::select('gender', array(null=>'Select', 'Male'=>'Male','Female'=>'Female'), null, ['class'=>'form-control', 'style'=>'width: 30%;']) !!}
            {!! Form::submit('Register', ['class'=>'btn btn-default register']) !!}
            {!! Form::close() !!}
        </div>
        <div class="loginForm">
            <h3 class="text-center">Login</h3>
           {!! Form::open(['method'=>'POST', 'route'=>'login']) !!}
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class'=>'form-control']) !!}
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control','style'=>'margin-bottom: 30px;']) !!}
            <div class="text-center">
            {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
            {!! Form::label('remember_token', 'Remember Me:') !!}
            {!! Form::checkbox('remember_token', ' Remember Me') !!}
            </div>
            {!! Form::close() !!}
            @if(Session::has('login-message'))
                <div class="alert alert-danger loginErrors">
                    {{ Session::get('login-message') }}
                </div>
            @endif
        </div>
    <div class="registerError">
    @include('layouts.partials.errors')
    </div>

</div>
</body>
@include('layouts.partials.footer')
</html>
