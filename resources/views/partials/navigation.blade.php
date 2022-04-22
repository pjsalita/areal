<!-- Markup for Navigation including menu -->
<nav id="header" class="navigation">
    <div class="brand" data-role="brand">
        <a href="{{ route("home") }}">
            <img class="logo" src="{{ asset("assets/images/AReal.svg") }}" alt="AReal Logo" />
        </a>
    </div>
    <div class="hamburger">
        <div class="menu-btn" data-role="menu-btn" class="intro">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>

    <!-- Markup for Overlay Menu -->
    <div class="menu" data-role="menu">
        <div class="menu-overlay -first" data-sequence="first"></div>
        <div class="menu-overlay -second" data-sequence="second"></div>
        <div class="menu-overlay -third" data-sequence="third">
            <ul class="menu-item">
                <li class="links">
                    <a href="{{ route("home") }}" data-role="menu-link" class="anchor">HOME</a>
                </li>
                <li class="links">
                    <a href="javascript:void(0)" data-link="about" class="anchor">ABOUT APP</a>
                </li>
                <li class="links">
                    <a href="javascript:void(0)" data-link="our-team" class="anchor">OUR TEAM</a>
                </li>
                <li class="links">
                    <a href="javascript:void(0)" data-link="our-projects" class="anchor">OUR PROJECTS</a>
                </li>
                <li class="links">
                    @auth
                        <a href="/feed" class="anchor">MY FEED</a>
                    @else
                        <a href="javascript:void(0)" data-link="log-in" class="anchor">LOG IN</a>
                    @endauth
                </li>
                @auth
                    <li class="links">
                        <a href="{{ route('logout') }}" class="anchor">LOGOUT</a>
                    </li>
                @endauth
            </ul>
            <img class="image-overlay" src="{{ asset("assets/images/overlay1.jpg") }}" alt="Architecture Background" />
        </div>
    </div>
</nav>

@push('scripts')
    <script src="{{ asset('assets/js/navigation.js') }}"></script>
@endpush
