<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>

<body>

    <div class="employer-slider">
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex justify-content-between py-2">
                <div>
                    <a class="navbar-brand text-white h3" href="#">Pros<span class="text-info">Path</span></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="{{ route('employer') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="{{ route('employer') }}">Home</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('job.new') }}">Post Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">My Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Applicants</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div>
                    @if (Auth::check())
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle border border-secondary rounded px-3" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->first_name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('employer.profile') }}"><i
                                                class="fa-solid fa-user me-2"></i> Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button
                                                class="btn btn-link p-0 ms-3 align-baseline text-black text-decoration-none">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> {{ 'Logout ' }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    @else
                        <a href="{{ route('employer.register') }}"
                            class=" nav-employer text-decoration-none text-light">{{ 'Employer Register ' }}</a>
                    @endif
                </div>
            </div>
        </nav>

        @yield('text')
    </div>


    @yield('content')

    <footer>
        <div class="row p-5">
            <div class="col-3">
                <a class="navbar-brand text-white h3" href="#">Pros<span class="text-info">Path</span></a>
                <p class="mt-2">Copyright &copy; 2024, ProsPath</p>
            </div>
            <div class="col-3">
                <h5>ProsPath</h5>
                <a href="#">About Us</a>
                <a href="#">Contact Us</a>
                <a href="#">Terms and Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="col-3">
                <h5>Job Seekers</h5>
            </div>
            <div class="col-3">
                <h5>Employers</h5>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ session('title', 'Default Title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('message', 'Default message text goes here.') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pink" data-bs-dismiss="modal">Close</button>
                </div> --}}
                <h5>{{ session('title') }}</h5>
                <p class="mt-2">{{ session('message') }}</p>
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="btn pink" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

@if (session('title') && session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        });
    </script>
@endif

<script>
    function loadFile(event) {
        var reader = new FileReader();

        reader.onload = function() {
            var output = document.getElementById('image');
            output.src = reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</html>
