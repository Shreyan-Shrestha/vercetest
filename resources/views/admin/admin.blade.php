@extends('partials.adminlay')
@section('title','DE-FORT | ADMIN PANEL')

@section('content')
<div>
    <h2>Welcome to Admin Panel</h2>
    <p class="lead">Manage website content and settings from here.</p>
</div>

<div class="mt-4 row justify-content-center px-3 gap-3  text-center">
    <div class="card mb-3 col-md-2 shadow-sm">
        <div class="card-body justify-content-center align-items-center row">
            <div class="d-flex justify-content-center col-2">
                <i class="bi bi-question-circle-fill fs-1 text-primary"></i>
            </div>
            <div class="col">
                <h5 class="card-title">FAQs</h5>
                <p class="card-text text-primary">{{ $faqsCount }}</p>
            </div>
        </div>
        <a href="admin.faqs" class="stretched-link"></a>
    </div>
    <div class="card mb-3 col-md-2 shadow-sm">
        <div class="card-body row justify-content-center align-items-center">
            <div class="d-flex justify-content-center col-3">
                <i class="bi bi-briefcase-fill fs-1 text-primary"></i>
            </div>
            <div class="col-9">
                <h5 class="card-title">Projects</h5>
                <p class="card-text text-primary">{{ $projectsCount }}</p>
            </div>
        </div>
        <a href="admin.projects" class="stretched-link"></a>
    </div>

    <div class="card mb-3 col-md-2 shadow-sm">
        <div class="card-body justify-content-center align-items-center row">
            <div class="d-flex justify-content-center col-2">
                <i class="bi bi-journal-text fs-1 text-primary"></i>
            </div>
            <div class="col">
                <h5 class="card-title">Blog Posts</h5>
                <p class="card-text text-primary">{{ $blogsCount }}</p>
            </div>
            <a href="{{ route('blog.admin.posts.index') }}" class="stretched-link"></a>
        </div>
    </div>
    <div class="card mb-3 col-md-2 shadow-sm">
        <div class="card-body justify-content-center align-items-center row">
            <div class="d-flex justify-content-center col-2">
                <i class="bi bi-envelope-arrow-down fs-1 text-primary"></i>
            </div>
            <div class="col">
                <h5 class="card-title">Messages</h5>
                <p class="card-text text-primary">{{ $messagesCount }}</p>
            </div>
        </div>
        <a href="admin.contact" class="stretched-link"></a>
    </div>
</div>
</div>
@endsection