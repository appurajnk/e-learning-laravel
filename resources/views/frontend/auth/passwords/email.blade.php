@extends('frontend.layouts.app')

@section('title', __('labels.frontend.passwords.reset_password_box_title') . ' | ' . app_name())


@section('content')
    <section class="h-75 py-4 my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="text-uppercase fw-500 text-center font-22 mb-4">
                                @lang('labels.frontend.passwords.reset_password_box_title')
                            </h4>

                            <div class="px-4">
                                @include('includes.partials.messages')
                                @if(session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}
                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="email" autofocus autocomplete="off" required name="email"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.email')</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary primery-bg-color btn-block font-16 fw-500 text-uppercase">
                                        @lang('labels.frontend.passwords.send_password_reset_link_button')
                                    </button>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
