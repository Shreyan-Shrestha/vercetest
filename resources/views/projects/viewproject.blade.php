@extends('partials.layout')
@section('title', $project->projectname . ' - DE-FORT Tech and Health')
@section('content')
<style>
    /* Custom width for 6 cards per row on large screens */
    @media (min-width: 992px) {
        .w-lg-16 {
            flex: 0 0 33.333%;
            max-width: 33.333%;
        }
    }
</style>
<div class="content py-2">
    <div class="d-flex flex-row flex-wrap">
        <div class="flex-fill mb-4 px-2">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0 fs-5">{{ $project->projectname }}</h3>
                </div>
                <div class="card-body p-3">
                    @if($project->image)
                    <div class="ratio ratio-4x3 bg-light position-relative overflow-hidden">
                        <img src="{{ asset('storage/' . $project->image) }}"
                            class="w-100 h-100 object-fit-cover"
                            alt="{{ $project->projectname }}"
                            loading="lazy"
                            decoding="async">
                    </div>
                    @else
                    <div class="ratio ratio-4x3 bg-light position-relative overflow-hidden">
                        <img src="https://placehold.co/800x450?text={{ urlencode($project->projectname) }}"
                            class="w-100 h-100 object-fit-cover"
                            alt="{{ $project->projectname }}"
                            loading="lazy"
                            decoding="async">
                    </div>
                    @endif
                    @if($project->clientname)
                    <h5 class="card-title fs-6"><strong>Client:</strong> {{ $project->clientname }}</h5>
                    @endif

                    <p class="card-text"><strong>Status:</strong>
                        <span class="badge {{ $project->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $project->status ? 'Completed' : 'Ongoing' }}
                        </span>
                    </p>

                    @if($project->startdate || $project->completeddate)
                    <div class="row mb-3">
                        @if($project->startdate)
                        <div class="col-6">
                            <p class="card-text"><strong>Started:</strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->startdate)->format('Y-m-d') }}</p>
                        </div>
                        @endif
                        @if($project->completeddate)
                        <div class="col-6">
                            <p class="card-text"><strong>Completed:</strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->completeddate)->format('Y-m-d') }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($project->category)
                    <p class="card-text"><strong>Category:</strong> {{ $project->category }}</p>
                    @endif

                    @if($project->location)
                    <p class="card-text"><strong>Location:</strong> {{ $project->location }}</p>
                    @endif

                    @if($project->description && strip_tags($project->description))
                    <div class="project-description d-none d-md-block">
                        <p class="card-text"><strong>Description:</strong></p>
                        <div class="ql-editor p-0" style="white-space: normal;">
                            @php
                            $cleanedDescription = $project->description;
                            $truncatedDescription = \Illuminate\Support\Str::words($cleanedDescription, 50, '...');
                            @endphp
                            {!! $truncatedDescription !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection