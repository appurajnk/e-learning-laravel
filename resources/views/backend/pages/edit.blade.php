@extends('backend.layouts.app')

@section('title', __('strings.pages') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col-8">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $language)
                    <li class="nav-item">
                        <a href="#language-{{ $language->carbon_code }}" class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}" data-toggle="tab" role="tab" aria-controls="language">
                            <img src="/flags/{{$language->carbon_code}}.svg" height="15"/>
                            {{ $language->name }} ({{ $language->carbon_code }})
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content card-min-height">
                @foreach($languages as $language)
                    <div class="tab-pane {{ $loop->iteration == 1 ? 'active' : '' }}" id="language-{{ $language->carbon_code }}" role="tabpanel">
                        <base-admin-pages-edit 
                            uuid="{{ $uuid }}"
                            locale="{{ $language->carbon_code }}"></base-admin-pages-edit>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <base-page-metainfo uuid="{{ $uuid }}"></base-page-metainfo>
        </div>

    </div><!--row-->
@endsection
