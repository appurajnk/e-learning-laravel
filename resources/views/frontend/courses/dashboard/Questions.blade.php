@extends('frontend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')
    @include('frontend.courses.dashboard._inc_dashboard_header', compact('course'))
    
    <section class="course__list py-4">
        <base-course-dashboard-questions :course="{{ json_encode($course) }}"></base-course-dashboard-questions>
    </section>
@endsection