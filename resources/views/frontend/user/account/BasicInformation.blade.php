@extends('frontend.layouts.app')

@section('title', __('strings.update_profile') . ' | ' . app_name())

@section('content')
    <div class="user-account-setting">
        <div class="container">
            <div class="row">
                <div class="col-md-3 course__author__menu">
                    @include('frontend.user.account._sidebar')
                </div>

                <div class="col-md-9">
                    <div class="setting-block shadow-sm" id="list-item-1">
                        <div class="setting-title font-22 fw-300">
                            @lang('strings.update_profile')
                        </div>
                        
                        <div class="setting-body white-bg-color">
                            <base-account-update :user="{{ auth()->user() }}"></base-account-update>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
