<!--- Markup for Create Post-->
@verified
<div class="mb-5 card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myPostTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#createPost" type="button" role="tab" aria-controls="createPost" aria-selected="true">
                    Create Post
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#createDesign" type="button" role="tab" aria-controls="createDesign" aria-selected="true">
                    Upload Design
                </button>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myPostTabContent">
        <div class="tab-pane fade show active" id="createPost" role="tabpanel">
            <form class="card-body" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="post">
                <div class="form-group">
                    <input class="mb-2 form-control" name="title" placeholder="Subject" required/>
                    <textarea class="form-control" name="body" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Publish Post</button>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="createDesign" role="tabpanel">
            <form class="card-body" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="design">
                <div class="form-group">
                    <input class="mb-2 form-control" name="title" placeholder="Design Name" required/>
                    <textarea class="mb-2 form-control" name="body" id="message" rows="3" placeholder="Design Description"></textarea>
                    <div class="mb-2 input-group">
                        <input type="file" name="model" class="form-control" id="designFile" accept=".obj" required>
                        <label class="input-group-text" for="designFile">Model File</label>
                    </div>
                    <div class="input-group">
                        <input type="file" name="image" class="form-control" id="designImage" onchange="previewImage(event)" accept=".png,.jpg,.jpeg,.svg,.gif,.bmp" required>
                        <label class="input-group-text" for="designImage">Image</label>
                    </div>
                </div>
                <div id="previewImages" class="my-2 row"></div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Publish Design</button>
                </div>
            </form>
        </div>
    </div>
</div>

@else

<div class="mb-5 card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myPostTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#createPost" type="button" role="tab" aria-controls="createPost" aria-selected="true">
                    Create Post
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#createDesign" type="button" role="tab" aria-controls="createDesign" aria-selected="true">
                    Upload Design
                </button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myPostTabContent">
            <div class="m-0 alert alert-warning" role="alert">
                Verify your email address to post.
            </div>
        </div>
    </div>
</div>
@endverified

@push("scripts")
    <script>
        const previewImage = (event) => {
            const imageTemplate = (file) => `<div class="mb-4 col-12 position-relative">
                <img src="${URL.createObjectURL(file)}" alt="" class="img-thumbnail" style="max-width: 100%; max-height: 100%;" />
                <!--<button type="button" class="btn-close position-absolute" aria-label="Close" style="top: 10px; right: 20px;"></button>!-->
            </div>`;
            const previewContainer = document.getElementById("previewImages");
            previewContainer.innerHTML = "";

            if (event.target.files.length > 0) {
                const files = event.target.files;
                Array.from(files).forEach(file => {
                    const template = imageTemplate(file);
                    const element = document.createElement('div');
                    element.innerHTML = template;
                    previewContainer.appendChild(element.firstChild);
                });
            }
        }
    </script>
@endpush
