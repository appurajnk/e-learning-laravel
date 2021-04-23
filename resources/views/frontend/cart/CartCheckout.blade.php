@extends('frontend.layouts.app')
@section('title', __('strings.shopping_cart') . ' | ' . app_name())
@section('content')
    <section class="text-white py-0 jumbotron__with_breadcrumb d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-4">
                    <nav aria-label="breadcrumb bg-transparent">
                        <ol class="breadcrumb bg-transparent mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="/"><i class="fa fa-home text-muted"></i></a>
                            </li>
                            <li class="breadcrumb-item text-white">@lang('strings.shopping_cart')</li>
                        </ol>
                    </nav>
                    <div class="font-34 fw-300">
                        @lang('strings.checkout')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course__list py-4 bg-white">
        <base-cart-checkout :payment_settings="{{ json_encode(setting('payments')) }}"
            site_name="{{ setting('site.site_name') }}" 
            site_currency="{{ setting('site.site_currency') ?? 'USD' }}"></base-cart-checkout>
    </section>
@endsection

@push('after-scripts')
    <script type="text/javascript" src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
@endpush