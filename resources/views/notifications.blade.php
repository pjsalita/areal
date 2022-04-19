@section('title', "Notifications")

<x-app-layout>
    <div class="my-3 container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => $user ])
            </div>
            <div class="col-md-9">
                <div class="mb-3 card">
                    <div class="card-header border-bottom-0">
                        <span>Notifications</span>
                        <span class="float-end">
                            <a href="?read=all" class="text-decoration-none">
                                <i class="fa fa-paint-brush"></i> Mark All As Read</span>
                            </a>
                    </div>
                </div>

                @forelse ($user->notifications as $notification)
                    @include('partials.feed.notification', [ 'notification' => $notification ])
                @empty
                <div class="text-center">
                    <p>No new notifications.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
