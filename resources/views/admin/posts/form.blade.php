@extends('partials.adminlay')

@section('content')
<div class="container justify-content-center">
    <h1 class="mb-4 display-5">{{ $post->exists ? 'Edit' : 'Create' }} Post</h1>

    <!-- CSRF token for JS image uploads -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Quill CSS (Snow theme) -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

    <form method="POST" action="{{ $post->exists ? route('blog.admin.posts.update', $post) : route('blog.admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        @if($post->exists) @method('PUT') @endif

        <div class="row">
            <div class="col-md-8">

                <div class="mb-4">
                    <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="form-control form-control-lg" required autofocus>
                    @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Body <span class="text-danger">*</span></label>
                    <div id="editor" style="height: 400px;"></div>
                    <textarea name="body" id="body-hidden" style="display:none;">{{ old('body', $post->body ?? '') }}</textarea>
                    @error('body')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="col-md-4 align-items-end d-flex mb-4">

                <div class="card w-100">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">None</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tags (comma separated)</label>
                            <input type="text" name="tags" value="{{ old('tags', $post->tags->pluck('name')->implode(', ') ?? '') }}" class="form-control" placeholder="e.g. Design, Construction, Nepal">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" class="img-thumbnail mt-3 d-block" style="max-height: 200px;" alt="Current featured image">
                                <small class="text-muted">Current image (upload new to replace)</small>
                            @endif
                            @error('featured_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="publish" id="publish" class="form-check-input" {{ old('publish', $post->published_at ? true : false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="publish">Publish immediately</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Save Post</button>
                            <button href="{{ route('blog.admin.posts.index') }}" class="btn btn-secondary btn-lg mt-2">Cancel</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

    <!-- Quill JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        // Initialize Quill
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: true
            }
        });

        // Load initial content
        const initialContent = @json(old('body', $post->body ?? ''));
        if (initialContent) {
            quill.root.innerHTML = initialContent;
        }

        // Custom image handler
        quill.getModule('toolbar').addHandler('image', function() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = () => {
                const file = input.files[0];
                if (file && /^image\//.test(file.type)) {
                    const formData = new FormData();
                    formData.append('image', file);

                    fetch('{{ route('blog.admin.upload.image') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, 'image', result.url);
                        quill.setSelection(range.index + 1);
                    })
                    .catch(error => {
                        console.error('Image upload failed:', error);
                        alert('Image upload failed. Please try again.');
                    });
                }
            };
        });

        // Sync to hidden textarea on submit
        const form = document.querySelector('form');
        form.onsubmit = function() {
            document.getElementById('body-hidden').value = quill.root.innerHTML;
        };
    </script>
</div>
@endsection