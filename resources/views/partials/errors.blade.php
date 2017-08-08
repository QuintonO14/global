@if ($errors->has('firstname'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
@endif
@if ($errors->has('lastname'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
@endif
@if ($errors->has('email'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
@endif
@if ($errors->has('password'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
@endif
@if ($errors->has('country_living'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('country_living') }}</strong>
                                    </span>
@endif
@if ($errors->has('gender'))
    <span class="registerErrors alert-danger">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
@endif