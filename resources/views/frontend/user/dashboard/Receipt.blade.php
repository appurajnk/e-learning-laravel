@extends('frontend.layouts.app')

@section('title', __('strings.receipt') . ' | ' . app_name())

@section('content')
    @include('frontend.user.dashboard._header', ['title' => __('strings.purchase_receipt'), 'show_menu' => false])

    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="h5 font-weight-bold">
                        @lang('strings.receipt') - {{ date('M. d, Y') }}
                    </h3>
                    <hr />
                </div>

                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="h5 font-weight-light">
                                {{ app_name() }}
                            </h3>
                            <p>{!! clean(setting('site.site_address')) !!}</p>
                        </div>
                        
                        <div>
                            <p>
                                <span class="font-weight-bold">@lang('strings.date'):</span> {{ $payment->created_at->format('M. d, Y')}}<br />
                                <span class="font-weight-bold">@lang('strings.order_no'):</span> {{ $payment->uuid }}
                            </p>
                        </div>
                    </div>
                    
                    <hr />
                </div>

                <div class="col-md-12">
                    <span class="font-weight-bold">@lang('strings.sold_to'):</span> {{ $payment->user->full_name }}<br />
                    <hr />
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered table-sm">
                        <thead class="font-weight-bold bg-light">
                            <td class="text-capitalize">@lang('strings.item')</td>
                            <td>@lang('strings.ordered')</td>
                            <td>@lang('strings.coupon')</td>
                            <td>@lang('strings.quantity')</td>
                            <td>@lang('strings.price')</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $payment->course->title }}</td>
                                <td>{{ $payment->created_at->format('M. d, Y')}}</td>
                                <td> {{ $payment->coupon ? $payment->coupon->code : ' - ' }} </td>
                                <td> 1 </td>
                                <td> <base-currency price="{{ $payment->amount }}"></base-currency> </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="text-right">@lang('strings.total')</td>
                                <td><base-currency price="{{ $payment->amount }}"></base-currency></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    
@endsection
