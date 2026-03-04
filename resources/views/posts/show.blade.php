@extends('partials.layout')
@section('title', $post->title . ' - DE-FORT Tech and Health')
@section('content')
<section>
    <div class="container my-4 px-4 px-md-5">
        <div class="mb-3">
            <a href="{{ route('blog.index') }}" class="text-decoration-none text-primary-subtle">&larr; Back to Posts</a>
        </div>

        <article>
            <div class="text-center mb-3">
                <h1 class="display-3 fw-bold text-primary-emphasis">{{ $post->title }}</h1>
                <p class="text-muted">
                    {{ $post->published_at?->format('M d, Y') ?? 'Draft' }}
                    @if($post->category)
                    • {{ $post->category->name }}
                    @endif
                    @if($post->tags->isNotEmpty())
                    • {{ $post->tags->pluck('name')->implode(', ') }}
                    @endif
                </p>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <div class="dropdown">
                    <a class="d-flex align-items-center gap-2"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-share-fill me-2"></i> Share
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2" style="min-width: 220px;">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!'); return false;">
                                <i class="bi bi-link-45deg me-3 fs-5"></i>
                                Copy link
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode('Check out this article: ' . url()->current()) }}">
                                <i class="bi bi-envelope me-3 fs-5"></i>
                                Email
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener">
                                <i class="bi bi-facebook me-3 fs-5 text-primary"></i>
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}"
                                target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp me-3 fs-5 text-success"></i>
                                WhatsApp
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener">
                                <i class="bi bi-twitter-x me-3 fs-5"></i>
                                X (Twitter)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                                target="_blank" rel="noopener">
                                <i class="bi bi-linkedin me-3 fs-5 text-primary"></i>
                                LinkedIn
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mb-4 justify-content-center align-items-center d-flex">
                @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}" style="height: 25rem; width: 100%; object-fit: cover;">
                @else
                <img src="https://placehold.co/1200x400?text={{ $post->title }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}" style="height: 25rem; object-fit: cover;">
                @endif
            </div>

            <div class="content mt-3">
                {!! $post->body !!}
            </div>
        </article>
        <div class="mb-3">
            <a href="{{ route('blog.index') }}" class="text-decoration-none text-primary-subtle">&larr; Back to Posts</a>
        </div>
    </div>
</section>
<hr class="container my-5">
<section class="container-fullwidth px-3 px-md-5 column mb-5">
    <div class="row mb-3 justify-content-center align-items-center">
        <div class="col-md-8">
            <h2 class="display-6 fw-bold">You might also like</h2>
            <p class="text-muted">Explore more articles from our blog</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="#" class="btn float-end btn-outline-primary px-5 py-2 mx-3 border-3">
                View All Blogs <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="d-md-flex flex-md-row mb-4 justify-content-between row reveal">
        @foreach($posts as $post)
        <div class=" row col-lg-4 mb-sm-2 d-flex align-items-stretch mt-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden d-flex h-100 flex-column p-3">
                <div class="position-relative">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 15.625rem; object-fit: cover;">
                    @else
                    <img src="https://placehold.co/400x250?text={{ $post->title }}" class="card-img-top" alt="{{ $post->title }}" style="height: 15.625rem; object-fit: cover;">
                    @endif

                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                            {{ $post->category?->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class=" align-items-center mb-3 text-primary small">
                        <span class="me-2">⏱</span>
                        {{ $post->read_time ?? '5 min read' }}
                    </div>
                    <h5 class="card-title fw-bold mb-3">{{ $post->title }}</h5>

                    <p class="card-text text-muted lead small">{{ $post->excerpt }}...
                    </p>

                    <div class="d-flex align-items-center mt-4 align-items-end text-primary small">
                        <span class="me-2">📅</span>
                        {{ $post->published_at?->format('jS M, Y') ?? 'Draft' }}
                    </div>
                    <a href="{{ route('blog.show', $post) }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection