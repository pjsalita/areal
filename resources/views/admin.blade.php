@section('title', "Admin")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.alerts')

                <div class="card">
                    <div class="card-header border-bottom-0">Users</div>
                    <div class="card-body">
                        @include('partials.admin.users', compact('users'))
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
