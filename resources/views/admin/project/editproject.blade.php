@extends('partials.adminlay')
@section('title', 'ADMIN PANEL | Projects')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm px-3" >
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Add a Project</h2>

                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Whoops!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.project.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input value="{{ $project['id'] }}" name="id" hidden>
                        <div class=" d-flex justify-content-center">
                        @if($project->image)
                        <img id="imagePreview" src="{{ asset('storage/' . $project->image) }}" alt="Image Preview" value="{{$project['image']}}" class="img-fluid mb-3" style="max-height: 200px;"/>
                        @endif
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label"><b>Image</b></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
                            <small class="form-text text-muted">Optional. Max size: 10MB. Accepted formats: JPEG, PNG, JPG, GIF, SVG, WebP.</small>
                        </div>

                        <div class="mb-3">
                            <label for="projectname" class="form-label"><b>Project Name</b></label>
                            <input type="text" class="form-control" id="projectname" name="projectname" value="{{$project['projectname']}}" maxlength="255" required>
                        </div>

                        <div class="mb-3">
                            <label for="clientname" class="form-label"><b>Client Name</b></label>
                            <input type="text" class="form-control" id="clientname" name="clientname" value="{{$project['clientname']}}" maxlength="255">
                            <small class="form-text text-muted">Optional</small>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label"><b>Status</b></label>
                            <select class="form-select" id="status" name="status" value="{{$project['status']}}" required>
                                <option value="1">Completed</option>
                                <option value="0">Ongoing</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><b>Description</b></label>
                            <div id="editor" style="min-height: 200px;"></div>
                            <input type="hidden" id="description" name="description">
                            <small class="form-text text-muted">Required. Max 3000 characters.</small>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label"><b>Category</b></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="{{$project['category']}}" disabled selected>{{$project['category']}}. Change Category</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Urban Design">Urban Design</option>
                                <option value="Marketing">Construction</option>
                                <option value="Valuation">Valuation</option>
                                <option value="Project Management">Project Management</option>
                                <option value="Health">Health</option>
                                <option value="Interior Design">Interior Design</option>
                                <option value="Landscape Design">Landscape Design</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label"><b>Location</b></label>
                            <input type="text" class="form-control" id="location" name="location" value="{{$project['location']}}" maxlength="80" required>
                        </div>

                        <div class="mb-3">
                            <label for="startdate" class="form-label"><b>Start Date</b></label>
                            <input type="text" class="form-control datepicker" id="startdate" name="startdate" value="{{ $project['startdate'] }}" data-date-format="dd-mm-yyyy">
                            <small class="form-text text-muted">Optional. Format: YYYY-MM-DD</small>
                        </div>

                        <div class="mb-3">
                            <label for="completeddate" class="form-label"><b>Completed Date</b></label>
                            <input type="text" class="form-control datepicker" id="completeddate" name="completeddate" value="{{ $project['completeddate'] }}" data-date-format="dd-mm-yyyy">
                            <small class="form-text text-muted">Optional. Format: YYYY-MM-DD</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['clean']
                ]
            },
         value: 'Enter Project Description'
        });

          @if($project && $project['description'])
        quill.root.innerHTML = @json($project['description']);
        @else
        quill.root.innerHTML = '';
        @endif

        // Image preview
        $('#image').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#imagePreview').attr('src', event.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });
        // Sync Quill content to hidden input
        quill.on('text-change', function() {
            var content = quill.root.innerHTML;
            if (content.length > 3000) {
                quill.deleteText(3000, content.length);
            }
            document.getElementById('description').value = content;
        });

        // Validate on form submit
        document.querySelector('form').onsubmit = function() {
            var content = quill.getText().trim();
            if (content.length === 0) {
                alert('Description is required.');
                return false;
            }
            if (content.length > 3000) {
                alert('Description cannot exceed 3000 characters.');
                return false;
            }
            return true;
        };
    });
</script>
@endsection