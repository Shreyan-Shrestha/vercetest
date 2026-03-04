@extends('partials.layout')
@section('title', 'Blogs - DE-FORT Tech and Health')
@section('content')
<div class="container-fullwidth my-5">
    <section class="container-fullwidth column px-md-5 px-3 mt-5" id="pageintro">
        <div class="row d-flex justify-content-start reveal">
            <div class="col-8 col-sm-6">
                <div class="section-title d-flex align-items-center">
                    <span class="line-divider d-inline-block me-3" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                    <h5><span class="fw-bold"> Our Blogs & Articles</span></h5>
                </div>
                <p>
                <h1>Latest<span style="color: #007bff;"> updates</span>, built insights, and
                    <span class="text-primary">expert</span> news
                </h1>
                </p>
            </div>
        </div>
        <div class="section-subtitle col-lg-6 col-sm-10 mt-3 reveal">
            <p class="lead">
                Explore our diverse portfolio of successfully delivered engineering and construction projects
            </p>
        </div>
    </section>

    <section class="container-fullwidth mt-5 px-md-5 px-3">
        @if($posts->isNotEmpty())
        {{-- Featured Post (Latest Post - Horizontal Layout) --}}
        @php($featured = $posts->first())
        <div class="card mb-5 border-0 shadow-sm rounded-4 overflow-hidden bg-light">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6">
                    @if($featured->featured_image)
                    <img src="{{ asset('storage/' . $featured->featured_image) }}" class="img-fluid rounded-start w-100" style="height: 25rem; object-fit: cover;" alt="{{ $featured->title }}">
                    @else
                    <img src="https://placehold.co/600x400?text={{ $featured->title }}" class="img-fluid rounded-start w-100" alt="{{ $featured->title }} style="height: 25rem; object-fit: cover;"">
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-warning-subtle text-primary rounded-pill px-3 py-2 fs-6">
                                {{ $featured->category?->name ?? 'Uncategorized' }}
                            </span>
                            <span class="text-muted small">{{ $featured->read_time ?? '5 min read' }}</span>
                        </div>

                        <h1 class="display-5 fw-bold mb-4">{{ $featured->title }}</h1>
                        <p class="lead text-muted mb-4">{{ $featured->excerpt }}</p>

                        <div class="d-flex align-items-center mb-4">
                            <span class="text-primary fs-4 me-3">📅</span>
                            <span class="text-muted ms-2">{{ $featured->published_at?->format('jS F, Y') }}</span>
                        </div>

                        <a href="{{ route('blog.show', $featured) }}" class="text-primary fw-semibold fs-5 text-decoration-none">
                            Read full article →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest Blogs Heading --}}
        <h2 class="text-center fw-bold display-6 mb-5">Latest Blogs</h2>

        {{-- Grid of Remaining Posts (Image + Category Badge Only) --}}
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-4">
                <a href="{{ route('blog.show', $post) }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column">
                        <div class="position-relative">
                            @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 15.625rem; object-fit: cover;">
                            @else
                            <img src="https://placehold.co/400x250?text={{ $post->title }}" class="card-img-top" alt="{{ $post->title }}" style="height: 15.625rem; object-fit: cover;">
                            @endif

                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-warning-subtle text-primary rounded-pill px-3 py-2">
                                    {{ $post->category?->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3 text-primary small">
                                <span class="me-2">⏱</span>
                                {{ $post->read_time ?? '5 min read' }}
                            </div>

                            <h5 class="card-title fw-bold mb-3">{{ $post->title }}</h5>

                            <p class="card-text text-muted small flex-grow-1">{{ $post->excerpt }}</p>

                            <div class="d-flex align-items-center mt-4 text-primary small">
                                <span class="me-2">📅</span>
                                {{ $post->published_at?->format('jS M, Y') ?? 'Draft' }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <p class="text-muted fs-4">No blog posts available yet.</p>
        </div>
        @endif

        {{-- Pagination (Centered) --}}
        @if($posts->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $posts->links() }}
        </div>
        @endif
</div>
</section>
@endsection