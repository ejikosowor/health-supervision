<div class="sidebar" data-background-color="black" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('home') }}" class="simple-text">
               {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <ul class="nav">
            <li class="{{ Request::is('/') || Request::is('change-password') ? "active" : "" }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::user()->role_id == 1)
                <li class="{{ Request::is('users') || Request::is('users/*') ? "active" : "" }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="{{ Request::is('facilities') || Request::is('facilities/*') ? "active" : "" }}">
                    <a href="{{ route('facilities.index') }}">
                        <i class="fa fa-hospital-o"></i>
                        <p>Facilities</p>
                    </a>
                </li>
                <li class="{{ Request::is('counties') || Request::is('counties/*') ? "active" : "" }}">
                    <a href="{{ route('counties.index') }}">
                        <i class="fa fa-map-o"></i>
                        <p>Counties</p>
                    </a>
                </li>
                <li class="{{ Request::is('categories') || Request::is('categories/*') ? "active" : "" }}">
                    <a href="{{ route('categories.index') }}">
                        <i class="fa fa-tasks"></i>
                        <p>Supervision Categories</p>
                    </a>
                </li>
                <li class="{{ Request::is('supervisions') || Request::is('supervisions/*') ? "active" : "" }}">
                    <a href="{{ route('supervisions.index') }}">
                        <i class="fa fa-pencil"></i>
                        <p>Supervisions</p>
                    </a>
                </li>
            @elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                <li class="{{ Request::is('supervisions') || Request::is('supervisions/*') ? "active" : "" }}">
                    <a href="{{ route('supervisions.index') }}">
                        <i class="fa fa-pencil"></i>
                        <p>Supervisions</p>
                    </a>
                </li>
            @else
                <li class="{{ Request::is('online-supervisions') || Request::is('online-supervisions/*') ? "active" : "" }}">
                    <a href="{{ route('online-supervisions.index') }}">
                        <i class="fa fa-pencil"></i>
                        <p>Online Supervisions</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>