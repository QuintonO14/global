<div class="col-md-6">
    <ul class="list-group media-list media-list-stream">
        <li class="media list-group-item p-a" style="margin-bottom: 5px; margin-right: 0;">
            <div class="input-group">
                <div class="input-group-btn">
                    {!! Form::open(['method'=>'POST', 'action'=> 'PostController@store', $user->id, 'files'=>true]) !!}
                    {!! Form::hidden('dash_id', $user->id) !!}
                    {!! Form::text('body', null, ['class'=>'form-control', 'style'=>'width:570px', 'placeholder'=>'What is new with you?']) !!}
                    <div style="height:0px;overflow:hidden">
                        <input type="file" id="fileInput" name="photo_id" />
                    </div>
                    <button class="btn btn-default camera" type="button" data-toggle="tooltip" title="Add a Photo" style="height: 36px;" onclick="chooseFile();"><span class="em em-camera"></span></button>
                    {!! Form::close() !!}
                </div>
            </div>
        </li>

        @if(!$posts->count())
            <div class="alert alert-info alert-dismissible hidden-xs" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <a class="alert-link">This is where you start a Wave.</a> Waves spread and distribute energy as they travel, what you say could go a long ways!
            </div>
        @else
            <div class="infinite-scroll" id="infinite-scroll">
                @foreach($posts as $post)
                    <li class="media list-group-item p-a posts" data-postid="{{ $post->id }}">
                        <a class="media-left" href="">
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
                                <a href="{{route('profile.index', $post->user->id)}}" style="color: black; font-size: 15px;">{{$post->user->firstname}} {{$post->user->lastname}}</a>
                            </div>
                            <p>
                                {{ $post->body }}
                                @if($post->photo)
                                    <img class="img-responsive" style="width:150px; height: 150px; border-radius: 10px;" src="{{$post->photo->path}}">
                                @endif
                            </p>
                            <br>
                            <small class="pull-right text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                @include('partials.comments')
                            </small>
                        </div>
                    </li>
                @endforeach
                {{$posts->links()}}
            </div>
                @endif

    </ul>
</div>


