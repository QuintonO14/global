<div class="col-md-3">
    <div class="panel panel-default panel-profile m-b-md">
        @if(Auth::user()->hasFriendRequestPending($user))
        @elseif(Auth::user()->isFriendsWith($user))
        @else
            <a href="{{ route('friend.add', ['id' => $user->id]) }}" class="btn btn-primary addFriend">Add Friend</a>
        @endif
            <div class="panel-heading coverPhoto" style="background-image: url('{{$user->cover ? $user->cover->path : '/images/earth.jpg'}}');">
            </div>
            <div class="panel-body text-center">
                <img class="panel-profile-img"
                     @if($user->photo)
                     src="{{$user->photo->path}}"
                     @elseif($user->gender === 'Male')
                     src="/assets/img/male.jpg"
                     @elseif($user->gender === 'Female')
                     src="/assets/img/female.jpg"
                    @endif>
            <h5 class="panel-title">
                <a class="text-inherit">{{$user->firstname}} {{$user->lastname}}</a>
            </h5>
            <p class="m-b-md">{{ $user->status }}
            </p>
            <ul class="panel-menu">
                <li class="panel-menu-item">
                    Waves
                    <h5>{{$user->posts->count()}}</h5>
                </li>
                <li class="panel-menu-item">
                    <a href="#friendModal" class="text-inherit" data-toggle="modal" data-toggle="tooltip" title="View {{$user->name}}'s Friends">
                        Friends
                        <h5>{{$user->friends()->count()}}</h5>
                    </a>
                </li>
            </ul>
        </div>
            <div class="about">
                <p class="text-center" style="position: absolute; left: 193px;">About</p>
                <ul class="list-unstyled list-spaced">
                    <li><span class="em em-construction_worker"></span> Works at <strong>{{$user->job}}</strong>
                    <li><span class="em em-house"></span> Lives in <strong>{{$user->country_living}}</strong>
                    <li><span class="em em-round_pushpin"></span> From <strong>{{$user->country_from ? $user->country_from : $user->country_living}}</strong>
                </ul>
            </div>
    </div>
    @include('partials.friendModal')
</div>







