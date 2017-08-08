<div class="col-md-3" style="height: 500px; padding-right: 23px;">
    <div class="panel panel-default panel-profile m-b-md" style="height: 543px; padding-bottom: 15px; width: 312px;">
        <div class="panel-body" style="position: relative;">
            <h4 class="phototitle"> Latest Photos</h4>
            @if(!$photos->count())
                <img src="/images/earth.jpg" class="photoimage" alt="">
            @else
                @foreach($photos as $photo)
                    <div class="photoImage">
                        <img src="{{$photo->path}}" class="photoimage">
                    </div>
                @endforeach
            @endif
        </div>
        @if($user->photos->count() <= 6)
            <h6>{{$user->firstname}} has no more photos</h6>
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
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




