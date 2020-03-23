@extends('layouts.master')
@section('content')



<div class="container py-5 my-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-6">
                    <form action="{{ route('register') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="font-weight-bold my-3">
                                    ثبت نام در سایت
                                </div>
                            </div>




                            <div class="col-12 ">
                                <div class="form-group material-style">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder=" " value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                    <label for="name" class="">@lang('user::site.name')</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-12 ">
                                <div class="form-group material-style">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder=" " value="{{ old('email') }}" required autocomplete="email"
                                        autofocus>
                                    <label for="email" class="">@lang('user::site.email')</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="form-group material-style">
                                    <input id="mobile" type="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        placeholder=" " value="{{ old('mobile') }}" required autocomplete="mobile"
                                        autofocus>
                                    <label for="mobile" class="">@lang('user::site.mobile')</label>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="form-group material-style">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder=" " required autocomplete="new-password">
                                    <label for="password" class="">
                                        @lang('user::site.password')
                                    </label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-12 ">
                                <div class="form-group material-style">
                                    <input id="password-confirm" type="password" class="form-control" placeholder=" "
                                        name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm" class="">
                                        @lang('user::site.confirm_password')
                                    </label>
                                </div>
                            </div>





                            <div class="col-12 my-4">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-lg-6 ">
                                        <a class="mt-3 d-inline-block" href="{{ route('login') }}">
                                            قبلا ثبت نام کردی؟
                                        </a>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <button type="submit" class="btn btn-success w-100">
                                            @lang('user::site.register') </button>
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
