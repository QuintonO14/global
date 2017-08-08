<div class="modal fade" id="friendModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Friends of {{$user->firstname}}</h4>
            </div>
            @if(!$user->friends()->count())
                <h2 class="text-center"> You have no friends <i class="em em-pensive"></i></h2>
            @else
                <div class="modal-body-scroller">
                @foreach($user->friends() as $users)
                    <div class="modal-body p-a-0">
                        <div>
                            <ul class="media-list media-list-users list-group">
                                <li class="list-group-item" style="position: relative; padding-bottom: 0px;">
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-circle friend"
                                                 @if($users->photo)
                                                 src="{{$users->photo->path}}"
                                                 @elseif($users->gender === 'Male')
                                                 src="/assets/img/male.jpg"
                                                 @else
                                                 src="/assets/img/female.jpg"
                                                @endif
                                            >
                                        </a>
                                        <div class="media-body">
                                            <a href="{{route('profile.index', ['id'=> $users->id])}}">{{$users->firstname}} {{$users->lastname}}</a>
                                            <span style="float: right;">
                                                @if(Auth::id() === $user->id)
                                           <a href="{{ route('friend.delete', ['id'=> $users->id]) }}" class="btn btn-danger" style="float: right;"> Unfriend</a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
