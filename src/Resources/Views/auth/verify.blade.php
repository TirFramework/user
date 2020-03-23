@extends('layouts.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center my-5 py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">آدرس ایمیل خود را تأیید کنید</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    قبل از ادامه ، لطفاً ایمیل خود را بررسی و تأیید کنید. اگر ایمیل را دریافت نکردید ،
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            اینجا
                        </button>.
                    </form>
                    کلیک کنید تا مجدد برای شما ارسال شود
                </div>
            </div>
        </div>
    </div>
</div>
@endsection