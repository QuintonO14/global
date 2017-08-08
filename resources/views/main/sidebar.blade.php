<div class="col-md-3" style="height: 500px; padding-right: 23px;">
    <div class="panel panel-default panel-profile m-b-md" style="height: 543px; padding-bottom: 15px; width: 312px;">
        <div class="panel-body" style="position: relative;">
            <h4 class="phototitle"> Latest Photos</h4>
            @if(!$photos->count())
                <img src="/images/earth.jpg" class="photoimage" alt="">
                <div class="alert alert-info alert-dismissible hidden-xs" style="margin-top: 10px;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    This is where your photos are. Your six most recent photos will be displayed here.
                </div>
            @else
                @foreach($photos as $photo)
                    <div class="photoImage">
                    <img src="{{$photo->path}}" class="photoImage">
                    @if(Auth::user())
                        {!! Form::open(['method'=>'DELETE', 'class'=>'deleteThisPhoto', 'action'=> ['PhotoController@destroy', $photo->id]]) !!}
                        {!! Form::button('X',['type'=>'submit', 'class'=>'deletePhoto', 'data-token'=>csrf_token(), 'id'=>'deletePhoto', 'data-id'=>$photo->id, 'data-toggle'=>'tooltip', 'title'=>'Delete This Photo']) !!}
                        {!! Form::close() !!}
                    @endif
                    </div>
                @endforeach
            @endif
        </div>
        @if($user->photos->count() <= 6)
            <strong>{{$user->firstname}} has no more photos!</strong>
        @endif
        @if($user->photos->count() > 6)
        <button class="btn btn-pill" style="outline: none;" data-toggle="modal" data-target="#photoModal">View All Photos</button>
        @endif
        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modalPhotos">
                    <div class="modal-body">
                        @if($user->photos)
                            @foreach($user->photos as $photo)
                                <div class="photoDiv">
                                    <img class="modalImage" src="{{$photo->path}}" alt="">
                                    @if(Auth::user())
                                    {!! Form::open(['method'=>'DELETE', 'class'=>'deleteThisPhoto', 'action'=> ['PhotoController@destroy', $photo->id]]) !!}
                                    {!! Form::button('X',['type'=>'submit', 'class'=>'deleteModalPhoto', 'data-token'=>csrf_token(), 'data-id'=>$photo->id, 'data-toggle'=>'tooltip', 'title'=>'Delete This Photo']) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




