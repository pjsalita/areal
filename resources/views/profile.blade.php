@section('title', "{$user->name}")

<x-app-layout>
    <div class="my-3 container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => $user ])
            </div>
            <div class="col-md-9 gedf-main">
                @foreach ($user->posts as $post)
                    @include('partials.feed.post', [ 'post' => $post ])
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
