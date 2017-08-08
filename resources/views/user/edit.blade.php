@extends('layouts.main')

<body style="overflow: hidden; background-image: url('{{'/images/theearth.jpg'}}')">
<div class="edit-form">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-info alert-danger hidden-xs" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{$error}}
            </div>
        @endforeach
    @endif
    {!! Form::model($user, ['method'=>'PUT', 'action'=> ['UserController@update', $user->id], 'class'=>'form-horizontal', 'files'=>true]) !!}
    <div class="form-group-edit-left">
    {!! Form::label('firstname', 'First Name:') !!}
    {!! Form::text('firstname', null, ['class'=>'form-control']) !!}
    {!! Form::label('lastname', 'Last Name:') !!}
    {!! Form::text('lastname', null, ['class'=>'form-control']) !!}
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
    {!! Form::label('password', null, 'Password:') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group-edit-right">
    {!! Form::label('country_living', 'Where are you living?') !!}
    <select name="country_living" id="" class="form-control">
        <option value="{{$user->country_living}}" selected="{{$user->country_living}}">{{$user->country_living}}</option>
        @foreach($countries as $country)
            <option value="{{$country}}" class="form-control">{{$country}}</option>
        @endforeach
    </select>
    {!! Form::label('country_from', 'Where are you from?') !!}
    <select name="country_from" id="" class="form-control">
        <option value="{{$user->country_from}}" selected="{{$user->country_from}}">{{$user->country_from}}</option>
        @foreach($countries as $country)
            <option value="{{$country}}" class="form-control">{{$country}}</option>
        @endforeach
    </select>
    {!! Form::label('job', 'Occupation:') !!}
    {!! Form::text('job', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group-photo">
    {!! Form::label('photo_id', 'Change Profile Picture:', ['class'=>'photoLabel']) !!}
    {!! Form::file('photo_id') !!}
    <img style="width: 250px; height: 250px; border-radius: 100%;"
        @include('layouts.partials.avatars')
    >
        {{csrf_field()}}
    <br>
    {!! Form::submit('Update User', ['class'=>'btn btn-primary','style'=>'width: 250px;']) !!}
    {!! Form::close() !!}

    </div>
</div>
</body>