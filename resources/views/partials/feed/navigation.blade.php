<nav class="navigation navbar navbar-light bg-white">
    <div class="brand" data-role="brand">
        <a href="{{ route("home") }}">
            <img class="logo" src="{{ asset("/assets/images/AReal.svg") }}" alt="AReal Logo" />
        </a>
    </div>

    <form class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" aria-label="Recipient's username"
                aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</nav>
