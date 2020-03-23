@extends('layouts.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center my-5 py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ثبت کلمه عبور</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group material-style">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder=" ">
                                        <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>
                                        <span class="invalid-feedback" role="alert">
                                            @error('email')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group material-style">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder=" ">
                                        <label for="password" class=" text-md-right">{{ __('Password') }}</label>
                                        <span class="invalid-feedback" role="alert">
                                            @error('password')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group material-style ">
                                        <input id="password-confirm" placeholder=" " type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                        <label for="password-confirm" class=" text-md-right">{{ __('Confirm Password') }}</label>
                                    </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
