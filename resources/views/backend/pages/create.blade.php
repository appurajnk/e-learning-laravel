@extends('backend.layouts.app')

@section('title', __('strings.pages') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col-12">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#language" class="nav-link active" data-toggle="tab" role="tab" aria-controls="language">
                        <i class="fas fa-globe"></i> 
                        {{ $language->name }} ({{ $language->carbon_code }})
                    </a>
                </li>
            </ul>

            <div class="tab-content card-min-height">
                <div class="tab-pane active" id="language" role="tabpanel">
                    <base-admin-page-create locale="{{ $language->carbon_code }}"></base-admin-page-create>
                </div>
            </div>

        </div>
    </div><!--row-->
@endsection
