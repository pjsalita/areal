@section('title', "Admin APK Upload")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.alerts')

                <div class="card">
                    <div class="card-header border-bottom-0">APK Upload</div>
                    <div class="card-body">
                        <form action="{{ route('admin.apk-upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <strong>Last upload:</strong>
                                {{ $lastModified }}
                            </p>
                            <div class="mb-3 input-group">
                                <input type="file" name="apk" id="apk" class="form-control" accept=".apk">
                                <label class="input-group-text" for="apk">APK File</label>
                            </div>
                            <button class="btn btn-primary" type="submit">Upload</button>
			    <a href="{{ route('admin.apk-delete') }}" class="btn btn-danger text-decoration-none ms-1">Delete APK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
