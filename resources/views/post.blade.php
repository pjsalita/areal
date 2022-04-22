@section('title', Str::ucfirst($post->title))

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ?? $post->user ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.post', [ 'post' => $post ])
            </div>
        </div>
    </div>
</x-app-layout>
