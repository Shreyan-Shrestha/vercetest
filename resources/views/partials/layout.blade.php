<!DOCTYPE html>
<html lang="en">
@vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/css/contact.css', 'resources/css/index.css'])

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="DE-FORT">
    <meta name="description" content="We are DE-FORT, a full service [Civil/Structural/General] engineering and construction firm dedicated to shaping resilient infrastructure and inspiring spaces.For over 20 years, we've transformed complex challenges into enduring solutions, guided by an unwavering commitment to precision, partnership, and progress. We don't just build projects — we build trust, foster innovation, and deliver legacies that stand the test of time.
    Our comprehensive services span structural engineering, civil site development, construction management, and MEP engineering, all tailored to meet the unique needs of our clients. With a focus on quality, safety, and sustainability, we collaborate closely with architects, developers, and stakeholders to bring visionary projects to life across Nepal.
    ">
    <meta name="keywords" content="Nepal, DEFORT, defort, DE-FORT, Architecture, Construction, Kathmandu, Lalitpur, Design, construction company in nepal, engineer, BEST construction company in nepal, construction company near me, construction company in kathmandu, construction company in lalitpur, construction company in pokhara, construction company in nepal, architect company near me, architect company in kathmandu, architect company in nepal, civil engineering company near me, civil engineering company in kathmandu, civil engineering company in lalitpur, civil engineering company in pokhara, civil engineering company in nepal,">
    @yield('meta')
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-16">
    <meta name="language" content="English">
    <meta name="revisit-after" content="30 days">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>@yield('title', 'DE-FORT Tech and Health')</title>
</head>

<body class="d-flex flex-column">
    <nav class="navbar justify-content-center bg-primary navbar-dark navbar-expand-lg" style="height: 5rem;">
        <div class="container-fluid w-100">
            <a class="navbar-brand p-0" href="/">
                <img class="logo" src="{{ asset('images/logo.png') }}" style="height: 4.5rem; width:auto" alt="DE-FORT Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hamburg" aria-controls="hamburg" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="hamburg" style="z-index: 1; width:100vw;">
                <ul class="navbar-nav ms-auto mb-lg-0 align-items-center text-white justify-content-evenly">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/services">
                            Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projects">
                            Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">
                            Blogs
                        </a>
                    </li>
                    <li class="nav-item pe-0">
                        <a class="nav-link pe-0" href="/contact"><button class="btn btn-light text-primary px-3">Contact Us</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container-fullwidth position-relative p-0 m-0" id="rotatedDivs">
        <div id="rotatewrapper">
            <div class="rounded-3" id="rotatedTop"></div>
            @yield('rotatedContent')
            <div class="rounded-2" id="rotatedBottom"></div>
        </div>
    </section>

    <section class="container-fullwidth position-relative p-0 m-0" id="alerts">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </section>

    <div class="container-full flex-grow-1 p-0 m-0">
        @yield('content')
    </div>


    <footer id="footer" class="container-fullwidth mb-0 pb-4 pt-5 px-3 text-white" style="background-color: #05285b;">
        <div class="container">
            <div class="row g-4 g-lg-5 justify-content-between">
                <div class="col-12 col-lg-4">
                    <img class="logo mb-3"
                        src="{{ asset('images/logo.png') }}"
                        style="height: 5rem; width: auto;"
                        alt="DE-FORT Logo">
                    <p class="mb-1" style="font-family: monospace; opacity: 0.9;">
                        We are DE-FORT, a full service [Civil/Structural/General] Engineering
                        and Construction firm dedicated to shaping resilient infrastructure
                        and inspiring spaces.
                    </p>
                    <i class="bi bi-facebook me-3 mt-4" style="font-size: 1.5rem;"></i>
                    <i class="bi bi-instagram me-3 mt-4" style="font-size: 1.5rem;"></i>
                    <i class="bi bi-linkedin me-3 mt-4" style="font-size: 1.5rem;"></i>
                </div>

                <div class="col-12 col-md-5">
                    <div class="row g-4 justify-content-between">
                        <div class="col-6 col-lg-5">
                            <h5 class="mb-3">Quick Links</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="/" class="text-white text-decoration-none">Home</a></li>
                                <li class="mb-2 "><a href="/about" class="text-white text-decoration-none">About Us</a></li>
                                <li class="mb-2 "><a href="/services" class="text-white text-decoration-none">Services</a></li>
                                <li class="mb-2 "><a href="/projects" class="text-white text-decoration-none">Projects</a></li>
                                <li class="mb-2 "><a href="/blog" class="text-white text-decoration-none">Blogs</a></li>
                                <li class="mb-2 "><a href="/contact" class="text-white text-decoration-none">Contact Us</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-lg-7">
                            <h5 class="mb-3">Services</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Structural Engineering & Design</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Civil & Site Development</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Construction Management</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">MEP Engineering</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <h5 class="mb-3">Contact Us:</h5>
                    <p class="mb-2"><i class="bi bi-telephone-fill me-2"></i>+9771-5444086</p>
                    <p class="mb-2"><i class="bi bi-envelope me-2"></i>info@defort.com</p>
                    <p class="mb-0"><i class="bi bi-geo-alt me-2"></i>Jawalakhel, Lalitpur Metropolitan City, Nepal</p>
                </div>

            </div>

            <div class="text-center mt-5 pt-4 border-top border-white border-opacity-25">
                <small>© 2026 DE-FORT. All rights reserved |
                    <a href="#" class="text-white text-decoration-none">Terms of Services</a> |
                    <a href="#" class="text-white text-decoration-none">Privacy Policy</a>
                </small>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.classList.remove('show');
                    successMessage.classList.add('fade');
                    // Remove the element from DOM after fade-out
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 2000);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.12 // start animation when ~12% of element is visible
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        //stop observing after animation plays once
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            reveals.forEach(el => observer.observe(el));
        });
    </script>
</body>

</html>