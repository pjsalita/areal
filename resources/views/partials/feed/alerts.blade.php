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

@if (session()->has('error'))
    <div class="mb-2 alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
