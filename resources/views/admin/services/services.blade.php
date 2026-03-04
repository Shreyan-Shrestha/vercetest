@extends('partials.adminlay')
@section('title','Admin Panel | Services')
@section('content')
<div class="container-fullwidth mt-5 bg-white rounded shadow-sm">
    <h2 class="mb-4">Services</h2>
    <p class="lead">Manage the services offered by DE-FORT. Add, edit, or delete service cards to keep your offerings up-to-date.</p>
    <a href="{{ route('admin.service.add') }}" class="btn btn-primary mb-3">Add New Service Card</a>
    <div class="row px-5">
        @foreach($services as $service)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-start">
                    <span class="px-2 mb-1 bg-primary-subtle rounded d-inline-block">
                        <i class="{{ $service->icon }} fs-3 text-primary mb-3"></i>
                    </span>
                    <h5 class="card-title text-primary">{{ $service->title }}</h5>
                    <p class="card-text lead">{{ $service->description }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection