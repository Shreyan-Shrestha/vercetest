@extends('partials.adminlay')
@section('title', 'FAQs Management | Edit FAQ')
@section('content')
<div class="container">
    <h1 class="mb-4 display-5">Edit FAQ</h1>
    <p class="lead">Update the details of an existing Frequently Asked Question.</p>

    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="question" class="form-label">The Question</label>
            <input type="text" class="form-control" id="question" name="question" value="{{ $faq->question }}" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">The Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="5" required>{{ $faq->answer }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update FAQ</button>
        <a href="{{ route('admin.faqs') }}" class="btn btn-secondary">Back to FAQs</a>
    </form>
</div>
@endsection