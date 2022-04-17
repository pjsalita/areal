@section('title', Str::ucfirst($post->title))

<x-app-layout>
    <div class="my-3 container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-{{ auth()->user()->account_type === "architect" ? "9" : "6" }}">
                @include('partials.feed.post', [ 'post' => $post ])
            </div>
        </div>
    </div>
</x-app-layout>
