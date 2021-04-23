@extends('backend.layouts.app')

@section('title', __('strings.payouts') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col">

            <base-admin-payout-details :period="{{ $period }}"></base-admin-payout-details>

        </div><!--col-->
    </div><!--row-->
@endsection
