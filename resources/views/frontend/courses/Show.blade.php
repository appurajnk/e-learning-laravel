@extends('frontend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')

    <base-course-header-lg :course="{{ json_encode($course) }}" :preview="{{ json_encode($preview) }}"></base-course-header-lg>
    <base-course-header-sm :course="{{ json_encode($course) }}"></base-course-header-sm>
    <section class="course__list py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <base-course-goals :course="{{ json_encode($course) }}"></base-course-goals>
                    <base-course-content :course="{{ json_encode($course) }}"></base-course-content>
                    <base-course-requirements :course="{{ json_encode($course) }}"></base-course-requirements>
                    <base-course-description :course="{{ json_encode($course) }}"></base-course-description>

                    <!-- Author bio -->
                    <base-course-author-bio :author="{{ json_encode($course->author) }}"></base-course-author-bio>

                    <!-- REVIEW SUMMARY -->
                    <base-course-review-summary :course="{{ json_encode($course) }}"></base-course-review-summary>
                    
                    <!-- REVIEWS -->
                    <base-reviews :course="{{ json_encode($course) }}"></base-reviews>
                </div>
            </div>
        </div>
    </section>
@endsection