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

                <ul class="nav nav-pills nav-fill" id="appointments">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#postsTab" type="button" role="tab">Posts</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#designsTab" type="button" role="tab">Designs</button>
                    </li>
                </ul>
                <div class="pt-4 tab-content" id="postsContent">
                    <div class="tab-pane fade show active" id="postsTab">
                        @forelse ($posts as $post)
                            @include('partials.feed.post', [ 'post' => $post ])
                        @empty
                            <div class="text-center">
                                <p>No posts available.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="designsTab">
                        @forelse ($designs as $post)
                            @include('partials.feed.post', [ 'post' => $post ])
                        @empty
                            <div class="text-center">
                                <p>No designs available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @client
                <div class="col-md-3">
                    <div class="mb-1 card">
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
</x-app-layout>
