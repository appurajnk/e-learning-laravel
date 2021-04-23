@extends('backend.layouts.app')

@section('title', __('strings.site_settings') . ' | ' . app_name())

@section('content')
    <div class="row">
        
        <div class="col-md-3">
            <div class="list-group" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="list-group-item list-group-item-action active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                    <i class="fas fa-cogs"></i>
                    @lang('strings.site_settings')
                </a>
                <a class="list-group-item list-group-item-action" id="v-pills-theme-tab" data-toggle="pill" href="#v-pills-theme" role="tab" aria-controls="v-pills-theme" aria-selected="true">
                    <i class="fas fa-palette"></i>
                    @lang('strings.theme_editor')
                </a>
                <a class="list-group-item list-group-item-action" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-video" role="tab" aria-controls="v-pills-video" aria-selected="false">
                    <i class="fas fa-video"></i>
                    @lang('strings.video_settings')
                </a>
                <a class="list-group-item list-group-item-action" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <i class="fas fa-coins"></i>
                    @lang('strings.currency_settings')
                </a>
                <a class="list-group-item list-group-item-action" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <i class="fas fa-credit-card"></i>
                    @lang('strings.payment_settings')
                </a>
                <a class="list-group-item list-group-item-action" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                    <i class="fas fa-envelope"></i>
                    @lang('strings.mail_settings')
                </a>
                
                <a class="list-group-item list-group-item-action" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-license" role="tab" aria-controls="v-pills-license" aria-selected="false">
                    <i class="fas fa-id-card"></i>
                    @lang('strings.license_information')
                </a>
            </div>
        </div><!--col-->

        <div class="col-md-9">
            <div class="tab-content card-min-height" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <base-site-settings :languages="{{ json_encode(active_languages()) }}"></base-site-settings>
                </div>

                <div class="tab-pane fade" id="v-pills-theme" role="tabpanel" aria-labelledby="v-pills-theme-tab">
                    <base-site-theme></base-site-theme>
                </div>

                <div class="tab-pane fade" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                    <base-video-settings></base-video-settings>
                </div>

                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <base-currency-settings></base-currency-settings>
                </div>

                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <base-payment-settings></base-payment-settings>
                </div>

                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <base-mail-settings></base-mail-settings>
                </div>
                
                <div class="tab-pane fade" id="v-pills-license" role="tabpanel" aria-labelledby="v-pills-license-tab">
                    <base-license-information></base-license-information>
                </div>
            </div>
            
        </div><!--col-->
    </div><!--row-->
@endsection
