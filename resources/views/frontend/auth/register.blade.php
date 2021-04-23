@extends('frontend.layouts.app')

@section('title', __('labels.frontend.auth.register_box_title') . ' | ' . app_name())

@section('content')
<section class="h-75 py-4 my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="text-uppercase fw-500 text-center font-22 mb-4">
                                @lang('labels.frontend.auth.register_box_title')
                            </h4>

                            <div class="px-4">
                                @include('includes.partials.messages')
                                {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="username" autocomplete="off" required name="username" value="{{ old('username') }}"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="username">@lang('strings.username')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="first_name" autocomplete="off" 
                                            required name="first_name" value="{{ old('first_name') }}"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="first_name">@lang('validation.attributes.frontend.first_name')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="last_name" autocomplete="off" required 
                                            name="last_name" value="{{ old('last_name') }}"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="last_name">@lang('validation.attributes.frontend.last_name')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="email" autocomplete="off" required name="email" value="{{ old('email') }}"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.email')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="password" type="password" required name="password" autocomplete="off" required
                                            class="form-control font-16 py-4 form-control-lg" placeholder=" ">
                                        <label for="password">@lang('validation.attributes.frontend.password')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="password_confirmation" type="password" required name="password_confirmation" autocomplete="off" required name="password_confirmation"
                                            class="form-control font-16 py-4 form-control-lg" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.password_confirmation')</label>
                                    </div>

                                    @if(config('access.captcha.registration'))
                                        <div class="form-label-groupx mb-3 floating-label">
                                            @captcha
                                            {{ html()->hidden('captcha_status', 'true') }}
                                        </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary primery-bg-color btn-block font-16 fw-500 text-uppercase">
                                        @lang('labels.frontend.auth.register_button')
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

@push('after-scripts')
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
