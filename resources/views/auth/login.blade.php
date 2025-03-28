<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applicant Sign In - ProsPath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container-fluid bg-blue text-dark d-flex justify-content-center align-items-center">

        <div class="row pt-4 zero-margin d-flex">

            <div class="col-12 col-lg-6 py-4 px-5 bg-white">
                <h2 class="mb-4">Login</h2>
                <h5>Welcome Back!</h5>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="hidden" value="employer" name="role">

                    <!-- Email Address -->
                    <div class="mt-4">

                        <input class="form-control" type="text" name="email" value="{{ old('email') }}"
                            placeholder="Email Address" required>
                        @error('email')
                            <small class="text-sm text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <input class="form-control" type="password" name="password" placeholder="Password">
                        @error('password')
                            <small class="text-sm text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <input type="submit" class="btn pink w-100" value="Login">
                    </div>

                    <!-- Link to Login -->
                    <div class="mt-4">
                        <span class="d-block">Don't have an account? <a href="{{ route('register') }}">Register now.</a></span>
                        <a href="{{ route('employer.login') }}" class="text-decoration-none">Login as Employer</a>
                    </div>
                </form>
                <hr class="my-4">
                <a href="{{ url('/auth/google/redirect') }}" class="text-decoration-none">
                    <div class="google d-flex justify-content-center align-items-center p-1 rounded">
                        <img src="{{ asset('images/google.png') }}" class="me-4">
                        <span class="text-black">Sign in with Google</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-6 register-img border-2">
                <h3 class="cover-text text-white">
                    Search for jobs that suit your interests and skills.
                </h3>
                <div class="row reg-logo d-flex align-items-end justify-content-between">
                    <a class="navbar-brand pros h3 ms-1 mb-3" href="#"><b>Pros</b><span class="path"><b>Path</b></span></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
