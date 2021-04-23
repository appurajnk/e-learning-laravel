@extends('frontend.layouts.app')

@section('title', __('strings.my_courses') . ' | ' . app_name())

@section('content')
    @include('frontend.user.dashboard._header', ['title' => __('strings.my_courses'), 'show_menu' => true])

    <base-user-courses></base-user-courses>
@endsection
