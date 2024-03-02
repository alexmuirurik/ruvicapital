@extends('layouts.guest')

@section('content')
    @include('components.header')

    <div class="main-wrapper auth min-vh-100 d-flex justify-content-center align-items-center text-center">
        <div class="container w-75 bg-body-tertiary m-auto rounded-3 pe-0 ps-0">
            <div class="row">
                <div class="form-responsive sign-in col-12 col-md-6">
                    <form method="post" action="{{route('password.request')}}">
                        @csrf
                        <h1 class="form-title my-4">Forgot Your Password?</h1>
                        <div class="social-icons mb-4">
                            <a class="social-icon" href="/"><i class="fa-brands fa-google"></i></a>
                            <a class="social-icon" href="/"><i class="fa-brands fa-facebook"></i></a>
                            <a class="social-icon" href="/"><i class="fa-brands fa-twitter"></i></a>
                            <a class="social-icon" href="/"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                        <span class="form-description"> or use your email for registeration</span>
                        <div class="form-inputs">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{request()->email}}">
                            </div>
                            <div class="form-group d-md-flex justify-content between">
                                <a class="btn btn-neutral btn-sm mb-3" href="{{route('login')}}">Login Instead?</a>
                                <button type="submit" class="btn btn-sm btn-primary ms-auto w-25">Request Password</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="toggle-container col-12 col-md-6 order-first order-md-last">
                    <div class="toggle">
                        <h1 class="mb-4">Hello, Friend!</h1>
                        <p>Request your personal details to use our site features</p>
                        <a class="btn btn-success mt-4" id="register" href="{{route('register')}}">Sign up</a>
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
            </div>
        </div>
    </div>

    {{-- @include('components.footer') --}}
@endsection
