<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge">{{auth()->user()->unreadNotifications->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">{{auth()->user()->unreadNotifications->count()}} Notifications</span>
                    <div class="dropdown-divider"></div>
                    @if(auth()->user()->unreadNotifications->count())
                        @foreach(auth()->user()->unreadNotifications->slice(0, 5) as $notification)
                            <form action="{{route('pengaduan.detail', $notification->data['id'])}}"  method="get" >
                                {{ csrf_field() }}
                                <a href="" class="dropdown-item">
                                    <input type="hidden" name="notif_id" value="{{$notification->id}}">
                                    <b style="font-size: 13px">{{$notification->data['nama']}}</b><span class="float-right text-muted text-sm"><button type="submit" class="btn btn-sm"><i class="fas fa-eye"></i></button></span>
                                    <p style="font-size: 13px">{{$notification->data['pengaduan']}}</p>
                                </a>
                            </form>
                        @endforeach
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{route('pengaduan.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>