@extends('frontend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')
    @include('frontend.courses.dashboard._inc_dashboard_header', compact('course'))
    
    <section class="course__list py-4">
        <base-course-dashboard-question-show 
            :course="{{ json_encode($course) }}" 
            :user="{{ auth()->user() }}"
            :p_question="{{ $question }}"></base-course-dashboard-show>
    </section>
@endsection