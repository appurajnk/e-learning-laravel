@extends('frontend.layouts.app')

@section('title', __('labels.frontend.auth.login_box_title') . ' | ' . app_name())

@section('content')

    <section class="h-75 py-4 my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="text-uppercase fw-500 text-center font-22 mb-4">
                                @lang('labels.frontend.auth.login_box_title')
                            </h4>

                            <div class="px-4">
                                @include('includes.partials.messages')
                                {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="email" autocomplete="off" required name="email"
                                            class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.email')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="password" type="password" required name="password" autocomplete="off" required
                                            class="form-control font-16 py-4 form-control-lg" placeholder=" ">
                                        <label for="password">@lang('validation.attributes.frontend.password')</label>
                                    </div>

                                    <div class="mt-2 mb-2 clearfix">
                                        <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-3">
                                            <input id="remember" name="remember" value="1" class="custom-control-input rounded-0" type="checkbox">
                                            <label class="custom-control-label" for="remember">
                                                @lang('labels.frontend.auth.remember_me')
                                            </label>
                                        </div>
                                        <a href="{{ route('frontend.auth.password.reset') }}" class="forgot-pass color-blue font-14 fw-400">
                                            @lang('labels.frontend.passwords.forgot_password')
                                        </a>
                                    </div>

                                    <button type="submit" class="btn btn-primary primery-bg-color btn-block font-16 fw-500 text-uppercase">
                                        @lang('labels.frontend.auth.login_button')
                                    </button>
                                {{ html()->form()->close() }}

                                @if( config('api.demo_credentials') )
                                    <div class="alert alert-warning mt-2">
                                        <h5 class="fw-600 mb-2">Demo Credentials</h5>
                                        <p>
                                            Admin User: admin@example.net / secret 
                                        </p>
                                        <p>
                                            Instructor: pwalker@example.net / secret
                                        </p>
                                    </div>
                                @endif    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
