@extends('layouts.guest')

@section('content')
    @include('components.header')

    <div class="main-wrapper auth min-vh-100 d-flex justify-content-center align-items-center text-center">
        <div class="container w-75 bg-body-tertiary m-auto rounded-3 ps-0 pe-0">
            <div class="row">
                <div class="toggle-container col-12 col-md-6 order-first">
                    <div class="toggle toggle-left">
                        <h1 class="mb-4">Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <a class="btn btn-success mt-4" id="login" href="{{route('login')}}">Sign in</a>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 position-relative">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-responsive sign-up col-12 col-md-6">
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <h1 class="form-title my-4">Create an Account</h1>
                        <div class="social-icons mb-4">
                            <a class="social-icon" href="/register"><i class="fa-brands fa-google"></i></a>
                            <a class="social-icon" href="/register"><i class="fa-brands fa-facebook"></i></a>
                            <a class="social-icon" href="/register"><i class="fa-brands fa-twitter"></i></a>
                            <a class="social-icon" href="/register"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                        <span class="form-description">Use your email for registeration</span>
                        <div class="form-inputs">
                            <div class="form-group d-flex gap-2">
                                <div class="col">
                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required="" value="{{old('firstname')}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required="" value="{{old('lastname')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{old('email')}}">
                            </div>
                            <div class="form-group d-flex gap-2">
                                <div class="col">
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option disabled selected value="">Gender...</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="mobile" class="form-control" placeholder="+234 xxx xxx xxxx " required="" value="{{old('password_mobile')}}">
                                </div>
                            </div>
                            <div class="form-group d-flex gap-2">
                                <div class="col">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required="" value="{{old('password')}}">
                                </div>
                                <div class="col">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="" value="{{old('password_confirmation')}}">
                                </div>
                            </div>
                            <div class="form-group d-md-flex">
                                @if (request()->query('referrer'))
                                    <input type="hidden" name="referrer" class="form-control" value="{{request()->query('referrer') ?? old('referrer')}}">
                                @endif
                                <a class="btn btn-sm btn-neutral" href="{{route('password.request')}}">Forgot Your Password?</a>
                                <button type="submit" class="btn btn-sm btn-primary ms-auto w-25">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('components.footer') --}}
@endsection
