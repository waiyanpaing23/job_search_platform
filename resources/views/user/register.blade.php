{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

    <x-text-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button class="ms-4">
        {{ __('Register') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applicant Register - ProsPath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            <div class="col-12 col-lg-5 py-4 px-5 bg-white">

                <h2 class="mb-4">Register</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="d-flex">
                        <div class="pe-1">
                            <div>
                                <input class="form-control mb-1" type="text" name="firstname"
                                    value="{{ old('firstname') }}" placeholder="First Name" autofocus>
                                @error('firstname')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="ps-1">
                            <div>
                                <input class="form-control ms-1" type="text" name="lastname"
                                    value="{{ old('lastname') }}" placeholder="Last Name" autofocus>
                                @error('lastname')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">

                        <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                            placeholder="Email Address">
                        @error('email')
                            <small class="text-sm text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <input type="radio" class="form-check-input " name="gender" value="Male">
                        <label class="form-check-label">
                            Male
                        </label>

                        <input type="radio" class="form-check-input ms-4" name="gender" value="Female">
                        <label class="form-check-label">
                            Female
                        </label>

                        <input type="radio" class="form-check-input ms-4" name="gender" value="Others">
                        <label class="form-check-label">
                            Others
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <input class="form-control" type="password" name="password" placeholder="Password">
                        @error('password')
                            <small class="text-sm text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">

                        <input class="form-control" type="password" name="password_confirmation"
                            placeholder="Confirm Password">
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
                        <p>Already registered? <a href="{{ route('login') }}">Click here to login.</a></p>
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
        </div>
    </div>
    </div>
    </div>

</body>

</html>
