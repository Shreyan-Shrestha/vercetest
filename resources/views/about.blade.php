@extends('partials.layout')
@section('title', 'About Us - DE-FORT')
<style>
    #forborder {
        background-image: linear-gradient(#87b0db, #87b0db),
            linear-gradient(#87b0db, #87b0db),
            linear-gradient(#87b0db, #87b0db),
            linear-gradient(#87b0db, #87b0db),
            linear-gradient(steelblue, steelblue);
        background-repeat: no-repeat;
        background-size: 5px 50%, 50% 5px, 5px 50%, 50% 5px;
        background-position: left bottom, left bottom, right top, right top;
    }

    #principles {
        border: solid #87b0db;
    }
</style>

@section('content')
<div class="container-fullwidth pt-md-5 pb-0">
    <section class="w-100 column px-md-5 px-3 mt-5 pt-sm-3" id="pageintro">
        <div class="row d-flex justify-content-start reveal">
            <div class="col-8 col-sm-6">
                <div class="section-title d-flex align-items-center">
                    <span class="line-divider d-inline-block me-3" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                    <h5><span class="fw-bold"> About Us</span></h5>
                </div>
                <p>
                <h1>About <span style="color: #007bff;">DE-FORT Tech</span></h1>
                </p>
            </div>
        </div>
        <div class="section-subtitle col-lg-6 col-sm-10 mt-3 reveal">
            <p class="lead">
                To engineer and build sustainable, high-performance solutions that improve
                communities, empower our clients, and set new standards for safety and quality
                in the industry.
            </p>
        </div>
    </section>

    <section class="container-fullwidth mt-5 py-5 px-md-5 px-3 position-relative">
        <div class="row align-items-center g-5">
            <!-- Image column -->
            <div class="col-12 col-lg-6 reveal">
                <div class="image-wrapper">
                    <img
                        class="img-fluid rounded"
                        src="{{ asset('images/homepage/sustain.jpg') }}"
                        alt="Sustainable engineering project"
                        style="aspect-ratio: 5/3; object-fit: cover;">
                </div>
            </div>

            <!-- Text column -->
            <div class="col-12 col-lg-6 reveal ps-lg-5">
                <h1>
                    To Engineer and Build
                    <span style="color: #007bff">Sustainable</span>,
                    <span style="color: #007bff">High-Performance</span> Solutions
                </h1>

                <p class="lead mt-4">
                    We are DE-FORT, a full service [Civil/Structural/General] engineering and construction firm
                    dedicated to shaping resilient infrastructure and inspiring spaces.
                </p>

                <p class="lead mt-4">
                    For over 20 years, we've transformed complex challenges into enduring solutions, guided by an
                    unwavering commitment to precision, partnership, and progress. We don't just build projects —
                    we build trust, foster innovation, and deliver legacies that stand the test of time.
                </p>
            </div>
        </div>
    </section>

    <section class="w-100 mt-5 px-md-5 px-3">
        <div class=" d-flex flex-column justify-content-center align-items-center reveal">
            <div class=" section-title d-flex flex-row align-items-center reveal">
                <span class="line-divider d-inline-block me-3 align-self-center" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                <h5><span class="fw-bold"> Our Core Values</span></h5>
            </div>
            <h2 class="mt-3">Our Guiding <span style="color: #007bff;">Principles</span></h2>
            <p class="lead mt-3">Our core values are the foundation of every decision we make, every relationship we build,
                every project we deliver.
            </p>
        </div>

        <div class="w-100 mt-5 d-flex flex-sm-row flex-wrap gap-4">
            <div class="card rounded h-100 flex-column b-0 p-3">
                <div class="row g-4 justify-content-center align-items-center h-100">
                    <div class="col-6 col-md-4 reveal">
                        <div class="card h-100 shadow-sm text-start" id="principles">
                            <div class="card-body d-flex flex-column justify-content-center p-3">
                                <div class="mb-3">
                                    <span class="p-3 bg-primary-subtle rounded d-inline-block">
                                        <i class="fa-solid fa-shield-heart text-primary fs-3"></i>
                                    </span>
                                </div>
                                <h6 class="card-title fw-bold text-primary mb-2">Integrity First:</h6>
                                <p class="card-text small text-muted mb-0">We do what's right, not what's easy. Honest communication and ethical practices are non-negotiable.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 reveal">
                        <div class="card h-100 shadow-sm text-start" id="principles">
                            <div class="card-body d-flex flex-column justify-content-center p-3">
                                <div class="mb-3">
                                    <span class="p-3 bg-primary-subtle rounded d-inline-block">
                                        <i class="bi bi-award text-primary fs-3"></i>
                                    </span>
                                </div>
                                <h6 class="card-title fw-bold text-primary mb-2">Relentless Excellence:</h6>
                                <p class="card-text small text-muted mb-0">From concept to completion, we pursue perfection in every detail, driven byquality and precision.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 reveal">
                        <div class="card h-100 shadow-sm text-start" id="principles">
                            <div class="card-body d-flex flex-column justify-content-center p-3">
                                <div class="mb-3">
                                    <span class="p-3 bg-primary-subtle rounded d-inline-block">
                                        <i class="fa-solid fa-brain text-primary fs-3"></i>
                                    </span>
                                </div>
                                <h6 class="card-title fw-bold text-primary mb-2">Innovative Thinking:</h6>
                                <p class="card-text small text-muted mb-0">We embrace new technologies and methodologies to solve old problems insmarter, more efficient ways.</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 reveal">
                        <div class="card h-100 shadow-sm text-start" id="principles">
                            <div class="card-body d-flex flex-column justify-content-center p-3">
                                <div class="mb-3">
                                    <span class="p-3 bg-primary-subtle rounded d-inline-block">
                                        <i class="fa-regular fa-handshake text-primary fs-3"></i>
                                    </span>
                                </div>
                                <h6 class="card-title fw-bold text-primary mb-2">Collaborative Partnership:</h6>
                                <p class="card-text small text-muted mb-0">We listen first. Your success is our success, and we achieve it through transparent teamwork.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 reveal">
                        <div class="card h-100 shadow-sm text-start" id="principles">
                            <div class="card-body d-flex flex-column justify-content-center p-3">
                                <div class="mb-3">
                                    <span class="p-3 bg-primary-subtle rounded d-inline-block">
                                        <i class="fa-solid fa-helmet-safety text-primary fs-3"></i>
                                    </span>
                                </div>
                                <h6 class="card-title fw-bold text-primary mb-2">Uncompromising Safety:</h6>
                                <p class="card-text small text-muted mb-0">We believe every person deserves to go home safely. Safety is a core value, not just a policy.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 mt-4 pt-md-5 px-3">
        <div class="mt-5 d-flex flex-column justify-content-center align-items-center">
            <div class=" section-title d-flex flex-row align-items-center">
                <span class="line-divider d-inline-block me-3 align-self-center" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                <h5><span class="fw-bold"> FAQs</span></h5>
            </div>
            <h2 class="mt-3">Frequently Asked <span style="color: #007bff;">Questions</span></h2>
        </div>
        <div class="justify-content-center align-items-center mt-4 d-flex">
            <div class="accordion col-12 p-0 p-md-5" id="faqs">
                @foreach ($faqs as $faq)
                <div class="accordion-item mt-3 reveal">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                            <strong>{{ $faq->question }}</strong>
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqs">
                        <div class="accordion-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section>

    <section class="container-fullwidth" id="footerCTA">
        <div class="p-5 text-start reveal row" style="background-color: #dce9ff;">
            <div class="col-12 col-lg-6">
                <h2 class="mb-3 text-primary">Need Specialized Expertise?</h2>
                <p class="mb-4">Our team of licensed professionals is ready to tackle your most complex engineering challenges.</p>
            </div>
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-lg-end">
                <button onclick="window.location.href='/contact'" class="btn btn-outline-primary px-5 py-2 border-3">Contact Us <i class="bi bi-arrow-right-short text-primary"></i></button>
            </div>
        </div>
    </section>
</div>
@endsection