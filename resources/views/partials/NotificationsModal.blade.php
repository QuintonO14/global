<div class="modal fade" id="notificationsModal" tabindex="-1" role="dialog" aria-labelledby="#notificationsModal" aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center">{{$user->firstname}}'s Friend Requests</h3>
            </div>
            <div class="modal-body p-a-0">
                <div class="modal-body-scroller">
                    <ul class="media-list media-list-users list-group paginate">
                        @if(!Auth::user()->friendRequests()->count())
                        <h4 class="text-center"> No New Friend Requests!</h4>
                        @endif
                        @if(Auth::user()->friendRequests())
                            @foreach(Auth::user()->friendRequests() as $request)
                                <li class="list-group-item friendItem">
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-circle friend"
                                                 @if($request->photo)
                                                     src="{{$request->photo->path}}"
                                                 @elseif($request->gender === 'Male')
                                                     src="/assets/img/male.jpg"
                                                 @else
                                                     src="/assets/img/female.jpg"
                                                 @endif >
                                        </a>
                                        <div class="media-body">
                                            <strong>{{$request->firstname}} {{$request->lastname}} wants to be your friend!</strong>
                                            <span style="float: right;">
                                                {!! Form::open(['method'=>'GET', 'id'=>'add', 'action'=> ['FriendController@getAdd', $request->id]]) !!}
                                                {!! Form::button('Accept', ['class'=>'btn btn-primary notificationButtons acceptBtn', 'data-token'=>csrf_token(), 'id'=>'friendAccept', 'data-id'=>$request->id]) !!}
                                                {!! Form::close() !!}
                                                <br>
                                                {!! Form::open(['method'=>'GET', 'id'=>'decline', 'action'=> ['FriendController@getDecline', $request->id]]) !!}
                                                {!! Form::button('Decline', ['class'=>'btn btn-danger notificationButtons declineBtn', 'data-token'=>csrf_token(), 'id'=>'friendDecline', 'data-id'=>$request->id]) !!}
                                                {!! Form::close() !!}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
