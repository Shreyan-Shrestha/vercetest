@extends('partials.layout')
@section('title','Our Services - DE-FORT Tech and Health')
<style>

    .column2 {
        border-left: 0.313rem solid #dae9ff;
    }

    #process .row:hover {
        i {
            color: #007bff !important;
            font-size: 6rem !important;
        }

        .column2 {
            border-left: 0.4rem solid #007bff !important;
        }

        .hasText span {
            background-color: #007bff !important;
        }
    }

    @media (max-width: 991.98px) {
        .hasText {
            font-size: small;
        }

        .column2 {
            border-left: 0.313rem solid #dae9ff;
            border-bottom: none;
        }

        #process .row:hover i {
            color: #007bff !important;
            font-size: 6rem !important;
        }

        #contact-button {
            font-size: small;
            padding: 0% !important;
        }
    }
</style>
@section('content')
<section class="column px-md-4 px-3 mt-5">
    <div class="row d-flex justify-content-start reveal">
        <div class="col-8 col-sm-6">
            <div class="section-title d-flex align-items-center">
                <span class="line-divider d-inline-block me-3" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
                <h5><span class="fw-bold"> Our Services</span></h5>
            </div>
            <p>
            <h1><span style="color: #007bff;">Engineering</span> Excellence,</h1>
            <h1><span style="color: #007bff;">Built</span> to Last</h1>
            </p>
        </div>
    </div>
    <div class="section-subtitle col-lg-6 col-sm-10 mt-3 reveal">
        <p class="lead">
            Specialized engineering and construction solutions that transform complex
            challenges into sustainable, high-performance realities. From initial concept to
            final commissioning, we deliver precision across every discipline.
        </p>
    </div>
</section>

<section id="services" class="w-100 px-md-5 px-3 pt-5 mt-5">
    <div class="row reveal g-4 justify-content-center">
        @foreach($services as $service)
        <div class="col-6 col-md-4 reveal">
            <div class="card h-100 border-0 text-start shadow-sm" style="background-color: #f1f6ff;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="mb-4">
                            <span class="p-3 px-4 bg-primary-subtle rounded d-inline-block">
                                @if($service->icon)
                                <i class="{{ $service->icon }} text-primary fs-1"></i>
                                @else
                                <i class="bi bi-briefcase-fill text-primary fs-1"></i>
                                @endif
                            </span>
                        </div>
                        <h5 class="card-title fw-bold text-primary mb-3">{{ $service->title }}</h5>
                        <p class="card-text small text-muted mt-auto mb-0">
                            {{ $service->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="w-100 column px-md-5 px-3 my-5" id="process">
    <div class=" d-flex flex-column justify-content-center align-items-center reveal">
        <div class=" section-title d-flex flex-row align-items-center reveal">
            <span class="line-divider d-inline-block me-3 align-self-center" style="background-color: #007bff; width:2.5rem; height:0.2rem;"></span>
            <h5><span class="fw-bold"> Our Process</span></h5>
        </div>
        <h1 class="mt-3 reveal"><span style="color: #007bff;">How We Work</span></h1>
        <p class="lead mt-3 reveal">Our proven, phased approach ensures predictable outcomes and
            minimizes risk at every stage.
        </p>
    </div>

    <div class="container-full mt-5 p-0 m-0 reveal">
        <div class="row" id="row-1">
            <div class="col-6 text-end column1 d-flex justify-content-end align-items-center pe-3">
                <i class="fa-solid fa-rotate" style="font-size: 4rem; color: #dae9ff"></i>
            </div>
            <div class="col-6 column2 justify-content-center align-items-center p-4 px-2 px-md-5 hasText pb-5">
                <span class="d-flex d-inline-block mb-3 justify-content-center align-items-center text-light" style=" height: 4rem; width: 4rem; border-radius: 50%; background-color: #dae9ff;">
                    <h4>1</h4>
                </span>
                <h4 class="text-primary mb-3">Discovery & Planning</h4>
                <p class="medium text-muted">We begin by deeply understanding your vision, constraints, and objectives. Our
                    team conducts comprehensive site analysis and feasibility studies to establish a
                    solid foundation. We translate your goals into a clear conceptual design and
                    realistic budget framework.</p>
            </div>
        </div>
        <div class="row" id="row-2">
            <div class="col-6 d-flex row justify-content-end align-items-center p-4 px-2 px-md-2 hasText text-end column1">
                <span class="d-inline-block mb-3 d-flex justify-content-center align-items-center text-light" style=" height: 4rem; width: 4rem; border-radius: 50%; background-color: #dae9ff;">
                    <h4>2</h4>
                </span>
                <h4 class="text-primary mb-3 p-0">Design & Engineering</h4>
                <p class="medium text-muted p-0">Our technical experts transform concepts into precise, buildable solutions. We
                    progress from schematic designs to detailed engineering calculations, ensuring
                    every structural, mechanical, and architectural element is optimized for
                    performance, safety, and cost.</p>

            </div>
            <div class="col-6 ms-4 ps-5 d-flex row text-start column1 d-flex justify-content-start align-items-center column2">
                <i class="fa-solid fa-pen-ruler" style="font-size: 4rem; color: #dae9ff"></i>
            </div>
        </div>
        <div class="row" id="row-3">
            <div class="col-6 text-end column1 d-flex justify-content-end align-items-center pe-3">
                <i class="fa-regular fa-paste" style="font-size: 4rem; color: #dae9ff"></i>
            </div>
            <div class="col-6 column2 justify-content-center align-items-center p-4 px-2 px-md-5 hasText pb-5">
                <span class="d-flex d-inline-block mb-3 justify-content-center align-items-center text-light" style=" height: 4rem; width: 4rem; border-radius: 50%; background-color: #dae9ff;">
                    <h4>3</h4>
                </span>
                <h4 class="text-primary mb-3">Discovery & Planning</h4>
                <p class="medium text-muted">We begin by deeply understanding your vision, constraints, and objectives. Our
                    team conducts comprehensive site analysis and feasibility studies to establish a
                    solid foundation. We translate your goals into a clear conceptual design and
                    realistic budget framework.</p>
            </div>
        </div>
        <div class="row" id="row-4">
            <div class="col-6 d-flex row justify-content-end align-items-center p-4 px-2 px-md-2 hasText text-end column1">
                <span class="d-inline-block mb-3 d-flex justify-content-center align-items-center text-light" style=" height: 4rem; width: 4rem; border-radius: 50%; background-color: #dae9ff;">
                    <h4>4</h4>
                </span>
                <h4 class="text-primary mb-3 p-0">Construction & Oversight</h4>
                <p class="medium text-muted p-0">Our team provides hands-on management throughout the build phase, overseeing
                    daily site operations with an emphasis on safety and schedule adherence. We
                    implement robust systems for progress monitoring, quality control inspections, and
                    proactive change</p>

            </div>
            <div class="col-6 ms-4 ps-5 d-flex row text-start column1 d-flex justify-content-start align-items-center column2">
                <i class="fa-solid fa-helmet-safety" style="font-size: 4rem; color: #dae9ff"></i>
            </div>
        </div>
        <div class="row" id="row-5">
            <div class="col-6 text-end column1 d-flex justify-content-end align-items-center pe-3">
                <i class="fa-solid fa-trophy" style="font-size: 4rem; color: #dae9ff"></i>
            </div>
            <div class="col-6 column2 justify-content-center align-items-center p-4 px-2 px-md-5 hasText pb-3">
                <span class="d-flex d-inline-block mb-3 justify-content-center align-items-center text-light" style=" height: 4rem; width: 4rem; border-radius: 50%; background-color: #dae9ff;">
                    <h4>5</h4>
                </span>
                <h4 class="text-primary mb-3">Closeout & Beyond</h4>
                <p class="medium text-muted">We ensure a polished transition from construction to occupancy through rigorous
                    final inspections and systems testing. Comprehensive training and documentation
                    are provided for all building systems, followed by structured warranty
                    administration.</p>
            </div>
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
            <button onclick="window.location.href='/contact'" class="btn btn-outline-primary px-5 py-2 border-3">Contact Us <i class="bi bi-arrow-right text-primary"></i></button>
        </div>
    </div>
</section>
@endsection