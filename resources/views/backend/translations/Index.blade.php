@extends('backend.layouts.app')

@section('title', __('strings.site_settings') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#languages" class="nav-link active" data-toggle="tab" role="tab" aria-controls="languages">
                        <i class="fas fa-globe"></i> 
                        @lang('strings.languages')
                    </a>
                </li>
            </ul>
            <div class="tab-content card-min-height">
                <div class="tab-pane active" id="languages" role="tabpanel">
                    <base-translations></base-translations>
                </div>
            </div>
        </div><!--col-->
    </div><!--row-->
@endsection
