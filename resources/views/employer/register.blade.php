<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employer Register - ProsPath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container-fluid bg-blue text-dark d-flex justify-content-center align-items-center">

            <div class="row pt-4 zero-margin d-flex justify-content-center">

                <div class="col-12 col-lg-5 register-img border-2">
                    <h3 class="cover-text text-white">
                        Search for jobs that suit your interests and skills.
                    </h3>
                    <div class="row reg-logo d-flex align-items-end">
                        <a class="navbar-brand pros h3 ms-1" href="#"><b>Pros</b><span class="path"><b>Path</b></span></a>
                    </div>
                </div>

                <div class="col-12 col-lg-5 py-4 px-5 bg-white d-flex flex-column justify-content-center">

                    <h2 class="mb-4">Register as Employer</h2>

                    <form method="POST" action="{{ route('employer.register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="d-flex">

                            <input type="hidden" value="employer" name="role">

                            <div class="pe-1">
                                <div>
                                    <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}"
                                    placeholder="First Name" required autofocus>
                                    @error('firstname')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="ps-1">
                                <div class="">
                                    <input class="form-control ms-1" type="text" name="lastname" value="{{ old('lastname') }}"
                                    placeholder="Last Name" autofocus>
                                    @error('lastname')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Email Address" required>
                            @error('email')
                            <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <input class="form-control" type="password" name="password"
                                placeholder="Password" required>
                            @error('password')
                            <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <input class="form-control" type="password" name="password_confirmation"
                                placeholder="Confirm Password" required>
                            @error('password_confirmation')
                            <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <input type="submit" class="btn pink w-100" value="Register">
                        </div>

                        <!-- Link to Login -->
                        <div class="mt-3">
                            <span class="d-block">Already registered? <a href="{{ route('employer.login') }}">Click here to login.</a></span>
                            <a href="{{ route('register') }}" class="text-decoration-none">Register as Applicant</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>

</body>

</html>
