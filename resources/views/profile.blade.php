@section('title', "{$user->name}")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => $user ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.alerts')

                @if ($user->account_type === "architect")
                <div class="d-flex">
                    <ul class="nav nav-pills nav-fill flex-grow-1" id="appointments">
                        <li class="nav-item">
                            <button class="nav-link {{ request()->view === "posts" || !request()->view ? "active" : "" }}" data-bs-toggle="tab" data-bs-target="#postsTab" type="button" role="tab">Posts</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link {{ request()->view === "designs" ? "active" : "" }}" data-bs-toggle="tab" data-bs-target="#designsTab" type="button" role="tab">Designs</button>
                        </li>
                    </ul>

                    <div class="btn-group ms-2">
                        <div data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <button class="btn btn-primary dropdown-toggle" type="button">
                                <i class="fa fa-qrcode"></i>
                            </button>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">
                                    Profile QR Code
                                </button>
                                <div class="p-0 dropdown-menu">
                                    <div class="d-flex flex-column">
                                        <div class="qrcode img-thumbnail">
                                            {!! QrCode::size(250)->generate(url("/profile/{$user->id}?view=designs")) !!}
                                        </div>
                                        <button class="btn btn-primary" onclick="downloadQr(event, '{{ $user->name }}')">
                                            Download QR Code
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div data-bs-toggle="dropdown">
                                    <button class="dropdown-item dropdown-toggle">
                                        Designs QR Code
                                    </button>
                                </div>
                                <div class="p-0 dropdown-menu">
                                    <div class="d-flex flex-column">
                                        <div class="qrcode img-thumbnail">
                                            {!! QrCode::size(250)->generate("designs:" . $user->id) !!}
                                        </div>
                                        <button class="btn btn-primary" onclick="downloadQr(event, '{{ $user->name }}')">
                                            Download QR Code
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pt-4 tab-content" id="postsContent">
                    <div class="tab-pane fade {{ request()->view === "posts" || !request()->view ? "show active" : "" }}" id="postsTab">
                        @forelse ($user->posts()->posts()->get() as $post)
                            @include('partials.feed.post', [ 'post' => $post ])
                        @empty
                            <div class="text-center">
                                <p>No posts available.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="tab-pane fade {{ request()->view === "designs" ? "show active" : "" }}" id="designsTab">
                        @forelse ($user->posts()->designs()->get() as $post)
                            @include('partials.feed.post', [ 'post' => $post ])
                        @empty
                            <div class="text-center">
                                <p>No designs available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
