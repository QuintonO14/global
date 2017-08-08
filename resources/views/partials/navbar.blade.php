<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
    <div class="mainContainer">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">
                <img src="/assets/img/planet.png" alt="">
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbar-collapse-main">

            <ul class="nav navbar-nav hidden-xs">
                <li class="active">
                    <a href="{{route('dashboard')}}" style="font-size: 17px;">Home</a>
                </li>
                <form action="" class="navbar-form navbar-right" role="search" id="formsearch">
                    <div class="input-group">
                        <input type="text" id="search" style="z-index: 9999 !important;" class="form-control inputSearch"  placeholder="Search..." />
                        <span class="input-group-btn">
                      <button class="btn btn-default searchBar">
                          <i class="fa fa-search searchNow"></i>
                      </button>
                            </span>
                    </div>
                </form>

            </ul>
            <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
                    <li id="searchInfo" role="alert">
                        This User Could Not Be Found
                    </li>
                <li style="height: 1px;" >
                    <a href="" data-target="#notificationsModal" style="outline: none;" class="friends" data-toggle="modal">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                    @if(Auth::user()->friendRequests()->count() > 0)
                    <sup class="badge btn-danger" style="position: relative; top: -30px;">{{Auth::user()->friendRequests()->count()}}</sup>
                    @endif
                </li>
                <li>
                    <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
                        <img class="img-circle navimage" @include('partials.avatars')>
                    </button>
                </li>
            </ul>

            <ul class="nav navbar-nav hidden">
                <li><a href="{{ route('user.edit', Auth::user())}}">Profile</a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


@include('partials.NotificationsModal')

