@extends('partials.adminlay')
@section('title', 'FAQs Management')
@section('content')
<div class="container">
    <h1 class="mb-4 display-5">FAQs Management</h1>
    <p class="lead">Manage the Frequently Asked Questions in the About page.</p>

    <!-- FAQ List -->
    <div class="mb-4">
        <a href="{{ route('admin.faq.add') }}" class="btn btn-primary mb-3">Add New FAQ</a>
        @if($faqs->isEmpty())
        <p>No FAQs found. Start by adding a new one!</p>
        @else
        <div class="list-group">
            @foreach($faqs as $faq)
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $faq->question }}</div>
                    {{ Str::limit($faq->answer, 100) }}
                </div>
                <div>
                    <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @endsection