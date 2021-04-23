@extends('frontend.layouts.app')
@section('title', __('strings.payout_settings') . ' | ' . app_name())
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
                            @lang('strings.payout_settings')
                        </div>
                        
                        <div class="setting-body white-bg-color">
                            <base-payout-settings :settings="{{ json_encode($settings) }}"></base-payout-settings>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
