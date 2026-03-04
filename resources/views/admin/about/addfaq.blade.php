@extends('partials.adminlay')
@section('title', 'FAQs Management | Add FAQ')
@section('content')
<div class="container">
    <h1 class="mb-4 display-5">Add New FAQ</h1>
    <p class="lead">Create a new Frequently Asked Question for the About page.</p>

    <form action="{{ route('admin.faq.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">The Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">The Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add FAQ</button>
        <a href="{{ route('admin.faqs') }}" class="btn btn-secondary">Back to FAQs</a>
    </form>
</div>
@endsection