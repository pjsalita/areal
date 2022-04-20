@section('title', Str::ucfirst((auth()->user()->account_type)) . " Feed")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-{{ auth()->user()->account_type === "architect" ? "9" : "6" }}">
                @architect
                    @include('partials.feed.create-post')
                @endarchitect

                @forelse ($posts as $post)
                    @include('partials.feed.post', [ 'post' => $post ])
                @empty
                    <div class="text-center">
                        <p>No posts available.</p>
                    </div>
                @endforelse
            </div>

            @client
                <div class="col-md-3">
                    <div class="card mb-1">
                        <div class="card-header border-bottom-0">Available Architects</div>
                    </div>

                    @forelse ($architects as $architect)
                        @include('partials.feed.architect', [ 'architect' => $architect ])
                    @empty
                        <div class="text-center">
                            <p>No architects available.</p>
                        </div>
                    @endforelse
                </div>
            @endclient
        </div>
    </div>

    @include('partials.feed.booking')
</x-app-layout>
