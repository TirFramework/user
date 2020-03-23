@extends('layouts.master')

@section('content')

<style>
    .mobileOrEmail-option .custom-control-label::after {
        display: none;
    }

    .mobileOrEmail-option .custom-control-label::before {
        display: none;
    }

    .mobileOrEmail-option .custom-control-input:checked~.custom-control-label svg {
        fill: #fff;
    }

    .mobileOrEmail-option .custom-control-input:checked~.custom-control-label {
        background: #007bff;
    }
</style>
<div class="container py-5 my-5">
    <div class="card my-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-6">
                    <div class="card-title mb-5">
                        تایید شماره تلفن
                    </div>


                    <form action="{{route('verificationByMobileOrEmail')}}" id="resend" method="POST" style="display: none">
                        <input type="hidden" value="mobile" name="mobileOrEmail">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm">ارسال مجدد</button>
                        </div>
                    </form>
                    <div id="clockdiv" class="p-3 text-center w-100">
                        <div>
                            '<span class="seconds">00</span>
                            <span class="smalltext"> ثانبه تا ارسال مجدد</span>
                        </div>
                    </div>

                    <form action="{{ route('verificationCode') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row align-items-center">


                            <div class="col-12 ">
                                <div class="form-group material-style mb-0">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder=" " value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                    <label for="name" class="">لطفا کد را وارد کنید</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>








                            <script>
                                initializeClock("clockdiv", 6000);

      function getTimeRemaining(endtime) {
        var t = endtime;
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
          total: t,
          days: days,
          hours: hours,
          minutes: minutes,
          seconds: seconds
        };
      }

      function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        clock.style.display = "block";
        // var daysSpan = clock.querySelector('.days');
        // var hoursSpan = clock.querySelector('.hours');
        // var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector(".seconds");
        function updateClock() {
          endtime = endtime - 1000;
          var t = getTimeRemaining(endtime);

          // daysSpan.innerHTML = (t.days);
          // hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
          // minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
          secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

          if (t.total <= 0) {
            // location.reload();
            $('#resend').show()
            $('#clockdiv').hide()
          }
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
      }
                            </script>









                            <div class="col-12 my-4">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-lg-6 ">
                                        <a href="{{ route('register')}}" class="w-100 btn btn-outline-danger mr-0 ml-0">
                                            <i class="fa fa-arrow-right ml-2"></i>
                                            بازگشت
                                        </a>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <button type="submit" class="btn btn-success w-100 mr-0 ml-0">
                                            فعال‌ سازی
                                        </button>
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
