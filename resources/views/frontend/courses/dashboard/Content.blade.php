@extends('frontend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')
    @include('frontend.courses.dashboard._inc_dashboard_header', compact('course'))
    
    <section class="course__list py-4">
        <div class="container">
            <base-course-content :course="{{ json_encode($course) }}" :user_can_access="true"></base-course-content>
        </div>
    </section>
@endsection