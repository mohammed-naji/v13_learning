@extends('site.master')

@section('title', 'Courses | ' . env('APP_NAME'))

@section('content')

    @include('site.header', ['title' => $course->title])

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Welcome {{ Auth::user()->name }}</h6>
                <h1 class="mb-5">{{ $course->title }} - ${{ $course->price }}</h1>

                <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
                <form action="{{ route('site.payment', $course->id) }}" class="paymentWidgets" data-brands="VISA MASTER AMEX CARTEBLEUE"></form>

            </div>

        </div>
    </div>
    <!-- Courses End -->

@stop
