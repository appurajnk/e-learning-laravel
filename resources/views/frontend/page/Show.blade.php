@extends('frontend.layouts.app')

@section('title', $page->title . ' | ' . app_name())

@push('after-styles')
@endpush

@section('content')
    <section class="text-white py-4 jumbotron__inner d-flex align-items-center">
        <div class="container">
            <div class="jumbotron__title">
                <h1>{{ $page->title }}</h1>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            {!! clean($page->body) !!}
        </div>
    </section>

@endsection
