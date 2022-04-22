<nav class="px-3 bg-white navigation navbar-expand-lg navbar navbar-light">
    <div class="brand" data-role="brand">
        <a href="{{ route("home") }}">
            <img class="logo" src="{{ asset("/assets/images/AReal.svg") }}" alt="AReal Logo" />
        </a>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="justify-content-end collapse navbar-collapse" id="navbarNav">
        @auth
            <div class="navbar-nav">
                <a class="nav-item nav-link text-decoration-none {{ request()->routeIs("feed") ? "active" : "" }}" href="{{ route("feed") }}">
                    <i class="fa fa-home"></i> <span class="d-inline d-lg-none"> Feed</span>
                </a>

                <a class="nav-item nav-link text-decoration-none {{ request()->routeIs("appointment.index") ? "active" : "" }}" href="{{ route("appointment.index") }}">
                    <i class="fa fa-calendar"></i> <span class="d-inline d-lg-none"> Appointments</span>
                </a>

                <a class="nav-item nav-link text-decoration-none position-relative {{ request()->routeIs("chat") ? "active" : "" }}" href="{{ route("chat") }}"
                    @unverified data-bs-toggle="tooltip" data-bs-placement="bottom" title="Verify your email address to access messages" @endunverified>
                    <i class="fa fa-envelope"></i>
                    <span class="badge rounded-pill bg-primary position-absolute" id="messagesCount" style="top: 5px; right: 0; font-size: 10px;">{{ auth()->user()->messages()->where('seen', 0)->count() > 0 ? auth()->user()->messages()->where('seen', 0)->count() : "" }}</span>
                    <span class="d-inline d-lg-none"> Messages</span>
                </a>

                <a class="nav-item nav-link text-decoration-none position-relative {{ request()->routeIs("notifications") ? "active" : "" }}" href="{{ route("notifications") }}">
                    <i class="fa fa-bell"></i>
                    <span class="badge rounded-pill bg-primary position-absolute" id="notificationCount" style="top: 5px; right: 0; font-size: 10px;">{{ auth()->user()->unreadNotifications->count() > 0 ? auth()->user()->unreadNotifications->count() : "" }}</span>
                    <span class="d-inline d-lg-none"> Notifications</span>
                </a>

                <a class="nav-item nav-link text-decoration-none {{ request()->routeIs("profile") ? "active" : "" }}" href="{{ route("profile") }}">
                    <i class="fa fa-user"></i> <span class="d-inline d-lg-none"> Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-item nav-link text-decoration-none" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa fa-sign-out"></i> <span class="d-inline d-lg-none"> Logout</span>
                    </a>
                </form>
            </div>
        @else
        <div class="navbar-nav">
            <a class="nav-item nav-link text-decoration-none {{ request()->routeIs("home") ? "active" : "" }}" href="{{ route("home") }}/?r=login">
                <i class="fa fa-sign-in"></i> <span class="d-inline"> Login</span>
            </a>
            <a class="nav-item nav-link text-decoration-none {{ request()->routeIs("home") ? "active" : "" }}" href="{{ route("home") }}/?r=signup">
                <i class="fa fa-user-plus"></i> <span class="d-inline"> Signup</span>
            </a>
        </div>
        @endauth
    </div>

    {{-- <form class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" aria-label="Recipient's username"
                aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form> --}}
</nav>
