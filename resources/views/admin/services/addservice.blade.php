@extends('partials.adminlay')
@section('title','Admin Panel | Add a Service')
@section('content')
<div class="content mt-5 px-5 bg-white rounded shadow-sm">
    <h2 class="mb-4">Add New Service Card</h2>
    <p class="lead">Fill out the form below to add a new service card to your website.</p>
    <form action="{{ route('admin.service.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="icon" class="form-label">Icon Class</label> <span class="lead fs-6"> <small class="form-text text-muted">Use Bootstrap Icons classes for the icon (e.g., <code>bi bi-briefcase-fill</code>).</small></span>
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="(e.g.bi bi-briefcase-fill)">
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="accordion mt-2 p-0 m-0" id="iconHelpAccordion">
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
                            The icon's page will display its class name (e.g., <code>bi bi-briefcase-fill</code>). Copy that class name and paste it into the Icon Class field above.
                            <img src="{{ asset('images/misc/service-icon-example.png') }}" alt="Icon Class Example" class="img-fluid mt-2 mb-3">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Service Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter service title">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Service Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter service description (Max 1000 characters)">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
        <a href="{{ route('admin.services') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection