@extends('frontend.layouts.app')

@section('title', __('strings.purchase_history') . ' | ' . app_name())

@section('content')
    @include('frontend.user.dashboard._header', ['title' => __('strings.purchase_history'), 'show_menu' => true])
    <section class="course__list py-4">
        <base-user-purchases :user="{{ auth()->user() }}"></base-user-purchases>
    </section>
@endsection
