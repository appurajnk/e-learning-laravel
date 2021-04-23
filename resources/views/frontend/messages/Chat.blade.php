@extends('frontend.layouts.app')
@section('title', __('strings.messages') . ' | ' . app_name())
@section('content')
    <section class="text-white py-0 jumbotron__with_breadcrumb d-flex align-items-center bg-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="font-34 fw-300">
                        @lang('strings.messages')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <base-chat :user="{{ auth()->user() }}"></base-chat>
@endsection
