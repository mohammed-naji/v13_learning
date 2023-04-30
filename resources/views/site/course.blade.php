@extends('site.master')

@section('title', 'Courses | ' . env('APP_NAME'))

@section('content')

    @include('site.header', ['title' => $course->title])

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">All Courses</h1>
                <p>{{ $course->content }}</p>
                <a href="{{ route('site.enroll', $course->id) }}" class="btn btn-primary">Enroll</a>
            </div>

        </div>
    </div>
    <!-- Courses End -->

@stop
