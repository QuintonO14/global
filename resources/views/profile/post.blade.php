<div class="col-md-6">
    <ul class="list-group media-list media-list-stream">
        @if(Auth::user()->isFriendsWith($user))
        <li class="media list-group-item p-a" style="margin-bottom: 5px; margin-right: 0;">
            <div class="input-group">
                <div class="input-group-btn">
                    {!! Form::open(['method'=>'POST', 'action'=> 'PostController@friendPostStore', $user->id, 'files'=>true]) !!}
                    {!! Form::hidden('dash_id', $user->id) !!}
                    {!! Form::text('body', null, ['class'=>'form-control', 'style'=>'width:570px', 'placeholder'=>'Post to ' . $user->firstname . "'s" . ' wall...']) !!}
                    {{ csrf_field() }}
                    <div style="height:0px;overflow:hidden">
                        <input type="file" id="fileInput" name="photo_id" />
                    </div>
                    <button class="btn btn-default camera" type="button" data-toggle="tooltip" title="Add a Photo" style="height: 36px;" onclick="chooseFile();"><span class="em em-camera"></span></button>
                    {!! Form::close() !!}
                </div>
            </div>
        </li>
        @elseif(Auth::user()->hasFriendRequestPending($user))
        <li class="media list-group-item p-a" style="margin-bottom: 5px; margin-right: 0;">
            <p> Waiting for {{$user->firstname}} to accept your friend request. </p>
        </li>
        @else
        <li class="media list-group-item p-a" style="margin-bottom: 5px; margin-right: 0;">
            <p class="text-center"> You must be friends with {{$user->firstname}} to post on their profile! </p>
        </li>
        @endif
        @if(!$posts->count())
            <h2 class="text-center"> This user has no posts yet. </h2>
        @else
            <div class="infinite-scroll">
                @foreach($posts as $post)
                    <li class="media list-group-item p-a posts" data-postid="{{ $post->id }}">
                        <a class="media-left" href="#">
                            <img class="media-object img-circle"
                                @if($post->user->photo)
                                src="{{$post->user->photo->path}}"
                                @elseif($post->user->gender === 'Male')
                                src="/assets/img/male.jpg"
                                @elseif($post->user->gender === 'Female')
                                src="/assets/img/female.jpg"
                                @endif
                             >
                        </a>
                        <div class="media-body">
                            <div class="media-heading">
                                <a href="{{route('profile.index', $post->user->id)}}" style="color: black; font-size: 15px;">
                                    {{$post->user->firstname}} {{$post->user->lastname}}
                                </a>
                            </div>
                            <p>
                                {{ $post->body }}
                                @if($post->photo)
                                    <img class="img-responsive" style="width:150px; height: 150px; border-radius: 10px;" src="{{$post->photo->path}}">
                                @endif
                            </p>
                            <br>
                            <small class="pull-right text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            @if(Auth::user()->isFriendsWith($user))
                                @include('partials.comments')
                            @endif
                        </div>
                    </li>
                @endforeach
                {{$posts->links()}}
            </div>
        @endif
    </ul>
</div>




