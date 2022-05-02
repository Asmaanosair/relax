@extends('layouts.app')

@section('content')
<!-- <audio class="relax-sound" src="audio/relax.mp3" autoplay="autoplay"></audio> -->
<div class="login">
    <div class="row h-100">
        <div class="login-container col-md-6">
            <form method="POST" action="{{ route('login') }}" class="form-login m-auto" style="width: 370px;">
                @csrf
                <div class="text-center">
                    <h1 class="mb-0">Relax</h1>
                    <p class="fw-bolder my-4 pb-2">Log in</p>
                </div>

                <div class="mb-4">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') ?? 'admin@gmail.com' }}" required autocomplete="email" autofocus
                        placeholder="Enter your email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" placeholder="Enter your password" value="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="accept-terms">
                    <label class="form-check-label" for="accept-terms">I accepted terms and condition</label>
                </div>

                {{-- <div class="form-check text-left ms-1">
                    <input type="checkbox" class="form-check-input p-0" id="accept-terms">
                    <label class="form-check-label" for="accept-terms">
                        I Accepted Terms And Condition
                    </label>
                </div> --}}

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary submit w-100">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-6 h-100 p-0 m-0 d-md-block d-none picture">
            <div class="over-layer"></div>
            <!-- <img class="w-100 h-100" src="https://images.pexels.com/photos/4173248/pexels-photo-4173248.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt=""> -->
        </div>
    </div>
</div>
@endsection
