@extends('layouts.master')

@section('content')
<div class="container py-5 my-5">
    <div class="card my-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-6">
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="font-weight-bold my-3">
                                    برای استفاده از امکانات سایت وارد شوید
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-group material-style">
                                    {{-- <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" --}}
                                    <input id="email" type="text" class="form-control"
                                        name="email" value="{{ old('email') }}" id="email"
                                        placeholder=" " required autocomplete="email" autofocus>
                                    <label for="email" class=" ">
                                        آدرس ایمیل یا شماره تلفن
                                    </label>
                                    {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror --}}

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group material-style">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" id="password" required autocomplete="password"
                                        placeholder=" ">
                                    <label for="password" class="">
                                        کلمه عبور
                                    </label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 my-4">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-lg-6 ">
                                        <a class="mt-3 d-inline-block" href="{{ route('register') }}">
                                            هنوز ثبت نام نکرده ام !
                                        </a>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <button type="submit" class="btn btn-success w-100">
                                            ورود به سایت
                                        </button>
                                        @if (Route::has('password.request'))
                                        <div>
                                            <a class="btn btn-link p-0 m-2" href="{{ route('password.request') }}">
                                                @lang('user::site.forgotـyourـpassword?')
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="d-none d-lg-flex col-lg-6 align-items-center">
                    <img src="/img/login.jpg" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
