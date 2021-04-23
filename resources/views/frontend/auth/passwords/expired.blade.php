@extends('frontend.layouts.app')


@section('title', __('labels.frontend.passwords.expired_password_box_title') . ' | ' . app_name())


@section('content')
    <section class="h-75 py-4 my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="text-uppercase fw-500 text-center font-22 mb-4">
                                @lang('labels.frontend.passwords.expired_password_box_title')
                            </h4>

                            <div class="px-4">
                                @include('includes.partials.messages')
                                {{ html()->form('PATCH', route('frontend.auth.password.expired.update'))->class('form-horizontal')->open() }}
                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="old_password" autofocus autocomplete="off" required name="old_password"
                                            class="form-control font-16 py-4 form-control-lg" type="password" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.old_password')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="password" autofocus autocomplete="off" required name="password"
                                            class="form-control font-16 py-4 form-control-lg" type="password" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.password')</label>
                                    </div>

                                    <div class="form-label-groupx mb-3 floating-label">
                                        <input id="password_confirmation" autofocus autocomplete="off" required name="password_confirmation"
                                            class="form-control font-16 py-4 form-control-lg" type="password" placeholder=" ">
                                        <label for="email">@lang('validation.attributes.frontend.password_confirmation')</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary primery-bg-color btn-block font-16 fw-500 text-uppercase">
                                        @lang('labels.frontend.passwords.update_password_button')
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
