@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body rounded-lg">
                    <p class="text-muted text-center pt-3 mb-5">Login dengan akun</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-4 shadow-sm">                           
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control border-0 text-muted {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email') }}"
                                   placeholder="Email"
                                   required autofocus>
                        </div>
                        <div class="input-group mb-2 mt-3 shadow-sm">                            
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control border-0 text-muted {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Password"
                                   required>
                                   @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                        </div>
                        <div class="form-group row pt-3">
                            <div class="col-md-6 ">
                                <div class="form-check ">
                                    <input class="form-check-input shadow-sm" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pt-3 mb-3">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                {{ __('Sign In') }}
                            </button>                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection