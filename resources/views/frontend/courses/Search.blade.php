@extends('frontend.layouts.app')

@section('title', __('strings.search') . ': ' . $query . ' | ' . app_name())

@section('content')
    <section class="text-white py-4 jumbotron__inner d-flex align-items-center">
        <div class="container">
            <div class="jumbotron__title">
                <h1><i class="fa fa-search"></i> {{ $query }}</h1>
            </div>
        </div>
    </section>

    <base-query-search query="{{ $query }}"></base-query-search>
@endsection