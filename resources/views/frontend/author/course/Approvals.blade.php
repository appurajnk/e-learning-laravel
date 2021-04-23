@extends('frontend.layouts.app')

@section('title', $course->title . ' - ' . __('strings.course_approval') . ' | ' . app_name())

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
                            @lang('strings.course_approval')
                        </div>
                        <div class="setting-body white-bg-color">

                            <div class="list-group">
                                @foreach($approvals as $approval)
                                    <div class="list-group-item flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-2 font-weight-bold text-{{ $approval->decision == 'approved' ? 'success' : 'danger'}} ">
                                                <i class="fa fa-thumbs-{{ $approval->decision == 'approved' ? 'up' : 'down'}}"></i>
                                                @lang('strings.'.$approval->decision)
                                            </h5>
                                            <small>{{ $approval->created_at->format('d-M-Y') }}</small>
                                        </div>
                                        <p class="mb-1">
                                            {{ $approval->comment }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection
