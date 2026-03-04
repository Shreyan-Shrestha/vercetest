@extends('partials.layout')
@section('title', 'Projects - DE-FORT Tech and Health')
<style>
    i {
        color: #0d95f0ff;
    }
</style>

@section('content')
<section class="container-fullwidth column px-md-5 px-2 mt-5" id="pageintro">
    <div class="row d-flex justify-content-start reveal">
        <div class="col-8 col-sm-6">
            <div class="section-title d-flex align-items-center">
                <span class="line-divider d-inline-block me-3" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                <h5><span class="fw-bold"> Our Projects</span></h5>
            </div>
            <p>
            <h1><span style="color: #007bff;">Building Excellence</span>: Our Projects Portfolio</h1>
            </p>
        </div>
    </div>
    <div class="section-subtitle col-lg-6 col-sm-10 mt-3 reveal">
        <p class="lead">
            Explore our diverse portfolio of successfully delivered engineering and construction
            projects.
        </p>
    </div>
    <div class="justify-content-center align-items-center text-center row mt-5 rounded reveal px-1 px-md-5">
        <div class="col-3 col-md-2 border-3">
            <p class="text-primary fs-3">500+</p>
            <p class="text-muted small keepsmall">Projects Completed</p>
        </div>
        <div class="col-3 col-md-2" style="border-left: 0.313rem solid #dae9ff; border-right: 0.313rem solid #dae9ff;">
            <p class="text-primary fs-3">15+</p>
            <p class="text-muted small keepsmall">Years of Excellence</p>
        </div>
        <div class="col-3 col-md-2">
            <p class="text-primary fs-3">98%+</p>
            <p class="text-muted small keepsmall">Client Satisfaction Rate</p>
        </div>
    </div>
</section>

<section class="mt-5 container-fullwidth px-5">
    <div class="container h-auto py-5">
        @if($projects->isEmpty())
        <div class="alert alert-info text-center">
            Please <a href="/contact">Contact us</a> for any project information, to learn about our services, for a consultatation, or for any other questions you wish to enquire about.
        </div>

        @else
        <div class="d-flex flex-column gap-5">
            @foreach($projects as $project)
            <div class="card border-0 bg-light shadow-sm h-100" style="height: 18.625rem !important;">
                <div class="row g-0 h-100">
                    <!-- Image column – fixed aspect or height controlled -->
                    <div class="col-lg-4 col-md-5 col-sm-4 bg-light position-relative">
                        <span class="badge bg-light-subtle position-absolute top-0 start-0 m-2 text-primary z-2">
                            {{ $project->category }}
                        </span>

                        @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}"
                            class="w-100 h-100 object-fit-cover rounded"
                            alt="{{ $project->projectname }}"
                            >
                        @else
                        <img src="https://placehold.co/600x400?text={{ urlencode($project->projectname) }}"
                            class="w-100 h-100 object-fit-cover rounded"
                            alt="{{ $project->projectname }}">
                        @endif
                    </div>

                    <!-- Content column -->
                    <div class="col-lg-8 col-md-7 col-sm-8">
                        <div class="card-body d-flex flex-column h-100 p-4 ps-lg-5 pt-3">

                            @if($project->projectname)
                            <h1 class="card-title text-primary-emphasis fw-bold mb-3">
                                {{ $project->projectname }}
                            </h1>
                            @endif

                            @if($project->location)
                            <p class="text-primary mb-3">
                                <i class="bi bi-geo-alt"></i> {{ $project->location }}
                            </p>
                            @endif

                            <div>
                                @if($project->description && strip_tags($project->description))
                                <p class="card-text text-muted mt-auto mb-4 flex-grow-1">{!! \Illuminate\Support\Str::words(strip_tags($project->description), 85,'<span class="text-primary">.....</span>') !!}</p>
                                @endif
                            </div>
                            <!-- Link to view project details page
                            <a href="/viewproject/{{ $project->id }}" class="btn btn-primary mt-auto align-self-start">
                                View Details
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4 px-3">
        {{ $projects->links() }}
    </div>
</section>

<section class="container-fullwidth" id="footerCTA">
    <div class="p-5 text-start reveal row" style="background-color: #dce9ff;">
        <div class="col-12 col-lg-6">
            <h2 class="mb-3 text-primary">Need Specialized Expertise?</h2>
            <p class="mb-4">Our team of licensed professionals is ready to tackle your most complex engineering challenges.</p>
        </div>
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-lg-end">
            <button onclick="window.location.href='/contact'" class="btn btn-outline-primary px-5 py-2 border-3">Contact Us <i class="bi bi-arrow-right text-primary"> </i></button>
        </div>
    </div>
</section>
@endsection