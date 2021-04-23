@extends('frontend.layouts.app')

@section('title', __('strings.instructor_dashboard') . ' | ' . app_name())

@section('content')
    @include('frontend.author.dashboard._header')

    <section class="course__list py-4">
        <base-author-statement-details statement="{{ $statement }}"></base-author-statement-details>
    </section>
@endsection
