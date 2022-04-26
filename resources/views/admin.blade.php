@section('title', "Admin")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header border-bottom-0">Users</div>
                    <div class="p-0 card-body">
                        @include('partials.admin.users', compact('users'))
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
