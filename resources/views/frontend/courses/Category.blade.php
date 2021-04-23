@extends('frontend.layouts.app')

@section('title', __('strings.online_courses_in_category', ['category' => $subcategory ? $subcategory->name : $category->name ]) . ' | ' . app_name() )

@section('content')
    <section class="text-white py-4 jumbotron__inner d-flex align-items-center">
        <div class="container">
            <div class="jumbotron__title">
                @if($subcategory)
                    <a href="{{ route('frontend.category', ['category' => $category->slug]) }}">
                        <h4 class="mb-2 text-light">
                            {{ $category->name }}
                        </h4>
                    </a>
                    <h1>{{ $subcategory->name }}</h1>
                @else
                    <h1>{{ $category->name }}</h1>
                @endif
            </div>
        </div>
    </section>
    <section class="bg-lightgrey mt-0 py-4">
        <div class="container">
            <base-search-filters
                category_id="{{ $subcategory ? $subcategory->id : $category->id }}"
                is_subcategory="{{ $subcategory ? true : false }}"></base-search-filters>
        </div>
    </section>

    <!-- Search Results -->
    <section class="course__list py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <base-search-results></base-search-results>
                </div>

                <!-- Right side -->
                <div class="col-md-3">
                    <div class="card card-body rounded-0 mb-4">
                        <h3 class="mb-2 font-18">
                            <i class="fa fa-shield"></i>
                            @lang('strings.not_sure')
                        </h3>
                        <p class="text-muted font-13">
                            @lang('strings.courses_have_guarantee')
                        </p>
                    </div>
                    
                    <div class="card card-body rounded-0 mb-4">
                        <h3 class="mb-2 font-18">
                            <i class="fa fa-users"></i>
                            @lang('strings.join_happy_students')
                        </h3>
                        <p class="text-muted font-13">
                            @lang('strings.join_happy_students_desc')
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection