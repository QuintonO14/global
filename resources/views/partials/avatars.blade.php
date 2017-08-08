@if(Auth::user()->photo)
    src="{{Auth::user()->photo->path}}"
@elseif(Auth::user()->gender === 'Male')
    src="/assets/img/male.jpg"
@elseif(Auth::user()->gender === 'Female')
    src="/assets/img/female.jpg"
@endif