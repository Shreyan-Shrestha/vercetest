<!DOCTYPE html>
<html>
@vite(['resources/css/app.scss', 'resources/js/app.js'])

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body style="background-color: #ddeeff; height: 90vh; max-height: 90vh;">
    <div class="container my-5 h-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-1 text-danger fw-bold">404</h1>
                <h2 class="text-primary-emphasis">Oops! Page not found</h2>
                <p class="lead mb-5">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                    Please check the URL and try again.
                </p>

                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-house-door-fill"></i> Go Back to Home
                </a>
            </div>
        </div>
    </div>

</body>

</html>