@section('title', "{$user->name}")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => $user ])
            </div>
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="mb-2 alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="mb-2 alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @include('partials.feed.update-profile', [ 'user' => $user ])
                @include('partials.feed.achievements', [ 'achievements' => $user->achievements ])
            </div>
        </div>
    </div>
</x-app-layout>
