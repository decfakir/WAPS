@extends('mainsite.layouts.app')

@section('title', config('app.name') . ' - Verify Email')

@section('header-class', 'header-style-one')

@section('content')
<!-- Start main-content -->
<section class="page-title" style="background-image: url(/mainsite-assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Verify Your Email</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('mainsite.home') }}">Home</a></li>
                <li>Email Verification</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!-- Email Verification Section -->
<section class="team-section pt-0">
    <div class="auto-container">

        <!-- Email Verification Form Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12 col-sm-12 mt-5">
                <div class="form-bg" style="background-image: url('/mainsite-assets/images/background/3.jpg');"></div>
                @include('partials._messages')

                <div class="inner-column">
                    <div class="contact-form wow fadeInLeft">
                        <p>Please your email and the 6-digit activation token sent to your email.</p>
                        <form method="post" action="{{ route('mainsite.verify-email.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="email" class="text-secondary">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="activation_token" class="text-secondary">Activation Token</label>
                                    <input type="text" id="activation_token" name="activation_token" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button style="width:100%" class="theme-btn btn-style-two btn-secondary" type="submit">
                                        <span class="btn-title">Verify Email</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-3">Didn't receive the email? 
                            <form action="{{ route('mainsite.resend-activation-token') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="mt-3 btn btn-outline-danger">Resend Token</button>
                            </form>
                        </p>
                        
                    </div>
                </div>
                

            </div>
        </div>
        <!-- End Email Verification Form Row -->
    </div>
</section>

@endsection
