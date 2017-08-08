<div class="col-md-3">
    <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-heading coverPhoto" style="background-image: url('{{$user->cover ? $user->cover->path : '/images/earth.jpg'}}');">
            {!! Form::open(['method' => 'PUT', 'id'=>'coverform', 'action' => ['UserController@updateCover', $user->id], 'files'=>true]) !!}
            <button class="btn btn-xs btn-default-outline coverButton"><i class="em em-busts_in_silhouette"></i> Cover Photo</button>
            {!! Form::file('cover_id', array('id'=>'cover_id', 'name'=>'cover_id', 'onChange'=>'form.submit()', 'style'=>'opacity: 0;', 'data-toggle'=>'tooltip', 'title'=>"This is your Cover Photo, click here to change it!")) !!}
            {!! Form::close() !!}
        </div>
        <div class="panel-body text-center">
            {!! Form::open(['method' => 'PUT', 'id'=>'photoform', 'style'=>'height: 40px;', 'action' => ['UserController@updateProfilePic', $user->id], 'files'=>true]) !!}
            <img class="panel-profile-img"
                 @if($user->photo)
                 src="{{$user->photo->path}}"
                 @elseif($user->gender === 'Male')
                 src="/assets/img/male.jpg"
                 @elseif($user->gender === 'Female')
                 src="/assets/img/female.jpg"
                 @endif>
            {!! Form::file('photo_id', array('class'=>'coverTrigger', 'id'=>'photo_id', 'onChange'=>'form.submit()', 'data-toggle'=>'tooltip', 'title'=>'This is your Profile Picture, click to change it!', 'name'=>'photo_id')) !!}
            {!! Form::close() !!}
            <h5 class="panel-title">
                <a class="text-inherit">{{$user->firstname}} {{$user->lastname}}</a>
            </h5>
            <p class="m-b-md">{{ $user->status }}
            </p>
            @if(Auth::user())
                <button type="button" data-toggle="modal" data-target="#editModal" class="editModal"><i class="em em-pencil2" data-toggle="tooltip" title="Edit Your Status" id="edit-modal"></i></button>
                @include('partials.editModal')
            @endif
            <ul class="panel-menu">
                <li class="panel-menu-item">
                    Waves
                    <h5>{{$user->posts->count()}}</h5>
                </li>
                <li class="panel-menu-item">
                    <a href="#friendModal" class="text-inherit" data-toggle="modal" data-toggle="tooltip" title="View Your Friends">
                        Friends
                        <h5>{{$user->friends()->count()}}</h5>
                    </a>
                </li>
            </ul>
        </div>
        <div class="about">
            <p class="text-center aboutEdit">About <small>·
                <a href="{{route('user.edit', $user->id)}}">Edit Profile</a></small></p>
            <ul class="list-unstyled list-spaced">
                <li><span class="em em-construction_worker"></span> Works at <strong>{{$user->job}}</strong>
                <li><span class="em em-house"></span> Lives in <strong>{{$user->country_living}}</strong>
                <li><span class="em em-round_pushpin"></span> From <strong>{{$user->country_from ? $user->country_from : $user->country_living}}</strong>
            </ul>
        </div>
    </div>
    @include('partials.friendModal')
</div>







