@section('title', "{$user->name}")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => $user ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.alerts')

                @include('partials.feed.update-profile', [ 'user' => $user ])

                @if ($user->account_type === "architect")
                    @include('partials.feed.achievements', [ 'achievements' => $user->achievements ])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
