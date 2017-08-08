<small class="post-footer">
    @if ($post->isLiked)
        <a href="{{ route('post.like', $post->id) }}" data-toggle="tooltip" title="Unlike This Post" ><i class="alreadyliked em em---1"></i></a><sub class="likeCount">{{$post->likes->count()}}</sub>
    @else
        <a href="{{ route('post.like', $post->id) }}" data-toggle="tooltip" title="Like This Post" ><i class="like em em---1"></i></a><sub class="likeCount">{{$post->likes->count()}}</sub>
    @endif
    @if(Auth::id() === $post->user->id or Auth::id() === $user->id)
        {!! Form::open(['method'=>'DELETE', 'action'=> ['PostController@destroy', $post->id]]) !!}
        {!! Form::button('', ['type'=>'submit','class'=>'em em-x deletesubmit', 'data-toggle'=>'tooltip', 'title'=>'Delete Post']) !!}
        {!! Form::close() !!}
        <button type="button" style="outline: none;" class="commentBtn1" data-toggle="tooltip" title="Leave a Comment..."><i class="em em-thought_balloon"></i><sub>{{$post->comments->count()}}</sub></button>
    @else
        <button type="button" class="commentBtn2" data-toggle="tooltip" title="Leave a Comment..."><i class="em em-thought_balloon"></i><sub>{{$post->comments->count()}}</sub></button>
    @endif
    <div class="commenthistory">

        @if($post->comments)
            @foreach($post->comments as $comment)
                <div class="comments">
                    <div class="media-heading">
                        <img class="commentuserphoto"
                             @if($comment->user->photo)
                             src="{{$comment->user->photo->path}}"
                             @elseif($comment->user->gender === 'Male')
                             src="/assets/img/male.jpg"
                             @elseif($comment->user->gender === 'Female')
                             src="/assets/img/female.jpg"
                                @endif
                        >
                        <a href="{{route('profile.index', ['id' => $comment->user->id])}}">
                            {{$comment->user->firstname}} {{$comment->user->lastname}}
                        </a>
                    </div>
                    <div style="padding-left: 10px;">
                        <p>{{$comment->body}}</p>
                        @if(Auth::id() === $comment->user->id or Auth::id() === $user->id)
                        <small class="pull-left text-muted">{{$comment->created_at->diffForHumans()}}</small>
                        {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentController@destroy', $comment->id]]) !!}
                        {!! Form::button('Delete',['type'=>'submit', 'class'=>'deletecomment']) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {!! Form::open(['method'=>'POST', 'action'=>'CommentController@createComment', 'class'=>'commentForm', 'id'=>'commentForm']) !!}
    {!! Form::hidden('post_id', $post->id) !!}
    {!! Form::hidden('user_id', $user->id) !!}
    {{csrf_field()}}
    <img class="commentphoto" @include('layouts.partials.avatars') >
    {!! Form::textarea('body', null, ['size'=>'50x2','class'=>'commentbox', 'style'=>'resize: none;', 'placeholder'=>'Write your comment here...']) !!}
    <div style="margin-top: 10px;">
        {!! Form::button('Comment', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
        {!! Form::button('Cancel', ['class'=>'btn btn-default cancelcomment']) !!}
    </div>
    {!! Form::close() !!}
</small>
