@extends('layouts.app')
@section('title')
Reset Password
@endsection
@section('main')
<section class=" p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                @include('layouts.message')
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h4 class="text-center">Create new password</h4>
                                    <h6 class="text-danger text-center" id="countdown-timer"></h6>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('account.resetpassword')}}" method="post">
                        @csrf
                                <input type="hidden" value="{{$email}}" name="email" id="email" placeholder="name@example.com">
                                <input type="hidden" value="{{$token}}" name="token" id="token" >
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password">
                                        <label for="password" class="form-label">Password</label>
                                        @error('password')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Password">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        @error('password_confirmation')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var createdAt = new Date("{{ @$tokenData->created_at}}");
        createdAt.setHours(createdAt.getHours() + 5);
        createdAt.setMinutes(createdAt.getMinutes() + 30);
        function updateCountdown() {
            var now = new Date();
            var elapsedTime = now-createdAt;
            var remainingTime = 300000 - elapsedTime;//300000 is 5 minutes
            if (remainingTime <= 0) {
                $('#countdown-timer').text("You can't reset the password now, the token has expired.");
                clearInterval(timerInterval); // Stop the timer when expired
            } else {
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                // Display the countdown in a "mm:ss" format
                $('#countdown-timer').text("Time left to reset password: " + minutes + "m " + seconds + "s");
            }
        }
        // Update countdown every second
        var timerInterval = setInterval(updateCountdown, 1000);
    });
</script>
@endsection