@extends('layouts.master')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center my-5 py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    بازیابی کلمه عبور
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group material-style">
                                    <input id="email" placeholder=" " type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">آدرس ایمیل </label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ارسال پسورد به ایمیل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
