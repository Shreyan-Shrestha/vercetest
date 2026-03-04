@extends('partials.adminlay')
@section('title','Admin Panel | Edit Service')
@section('content')
<div class="container-fullwidth mt-5 px-5 bg-white rounded shadow-sm">
    <h2 class="mb-4">Edit the Service Card</h2>
    <p class="lead">Update the details of the service card.</p>
    <form action="{{ route('admin.service.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="icon" class="form-label">Icon Class</label>
            @if($service->icon)
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="$service->icon">
            @else
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="No icon added yet">
            @endif
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="accordion col-9 mt-2 p-0 m-0" id="iconHelpAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            How to find icon classes?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            To find icon classes, visit the <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons library</a>.
                             Browse through the icons / Search for the icon you want and click on the one you want to use. 
                            The icon's page will display its class name (e.g., <code>bi bi-briefcase-fill</code>).
                            <img src="{{ asset('images/misc/service-icon-example.png') }}" alt="Icon Class Example" class="img-fluid mt-2 mb-3">
                            Copy that class name and paste it into the Icon Class field above.
                        </div>
                    </div>
                </div>
            </div>
            <small class="form-text text-muted">Use Bootstrap Icons classes for the icon (e.g., <code>bi bi-briefcase-fill</code>).</small>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Service Title</label><span class="lead fs-6"> ( Max 80 characters)</span>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" placeholder="Enter service title">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Service Description </label><span class="lead fs-6"> ( Max 1000 characters)</span>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Edit service description (Max 1000 characters)">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
        <a href="{{ route('admin.services') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection