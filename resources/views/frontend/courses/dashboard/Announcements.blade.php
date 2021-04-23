@extends('frontend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')
    @include('frontend.courses.dashboard._inc_dashboard_header', compact('course'))
    <section class="course__list py-4">
        <base-course-dashboard-announcements :course="{{ json_encode($course) }}" :user="{{ auth()->user() }}"></base-course-dashboard-announcements>
    </section>
@endsection