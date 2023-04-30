@extends('site.master')

@section('title', 'Courses | ' . env('APP_NAME'))

@section('content')

    @include('site.header', ['title' => 'Payment Status'])

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">

                <div class="alert alert-{{ $type }}">
                    {{ $msg }}
                </div>

            </div>

        </div>
    </div>
    <!-- Courses End -->

@stop
