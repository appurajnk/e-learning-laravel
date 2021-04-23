@extends('frontend.layouts.app')

@section('title', $course->title . ' - ' . __('strings.curriculum') . ' | ' . app_name())

@section('content')
    @include('frontend.author.course._header', compact('course'))
    <div class="user-account-setting">
        <div class="container">
            <div class="row">
                <div class="col-md-3 pt-4 course__author__menu">
                    @include('frontend.author.course._sidebar', compact('course'))
                </div>
                <div class="col-md-9">
                    <div class="setting-block shadow-sm" id="list-item-1">
                        <div class="setting-title font-28 fw-300">
                            @lang('strings.curriculum')
                        </div>
                        <base-author-course-curriculum :course="{{ json_encode($course) }}"></base-author-course-curriculum>
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection
