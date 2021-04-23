@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
    <style>
        /*
            This stype has to be in the view file because it is using 
            a variable from the database
        */
        .homepage .hero:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            background-image: url("{{ setting('site.homepage_image') }}") !important; 
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.9;
            background-size: cover;
        }
    </style>
@endpush

@section('content')
<section class="homepage">
    <section class="hero d-none d-lg-flex flex-row align-items-center text-left bg-secondary text-white">
  	    <div class="container">
            <div style="width: 40%;">
                <h1 class="font-28 fw-600 text-uppercase">@lang('strings.learn_on_your_schedule')</h1>
                <p class="font-18 font-weight-light mb-2">
                    @lang('strings.learn_on_your_schedule_sub')
                </p>            
                <div class="nav__search_wrapper ml-0">
                    <div class="nav__search">
                        <div class="nav__quick_search_form pos-r">
                            <div class="gabs__dropdown">
                                <base-nav-search></base-nav-search>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  	    </div>
    </section>
    
    <!-- HERO BOTTOM -->
    <section class="home__how_it_works_container d-none d-lg-block">
	    <div class="container home__how_it_works">
		    <div class="col-md-4 home__how_it_works_col d-flex pl-0">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-globe"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">@lang('strings.plus_online_courses')</span>
		            <div class="home__how_it_works-text-subtitle">
                    @lang('strings.plus_online_courses_sub')
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4 home__how_it_works_col d-flex">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-check-circle"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">@lang('strings.expert_instruction')</span>
		            <div class="home__how_it_works-text-subtitle">
                        @lang('strings.expert_instruction_sub')
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4 home__how_it_works_col d-flex">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-clock-o"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">@lang('strings.lifetime_access')</span>
		            <div class="home__how_it_works-text-subtitle">
                        @lang('strings.lifetime_access_sub')
		            </div>
		        </div>
		    </div>
	    </div>
    </section>

    @if(count($top_categories) > 0 )
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-flex">
                        <div class="bg-light p-4 flex-grow flex-fill d-flex text-center align-items-center flex-column justify-content-center">
                            <h5 class="fw-600 font-18 mb-2">
                                @lang('strings.join_happy_students')
                            </h5>
                            <p class="font-weight-light">@lang('strings.join_happy_students_desc')</p>
                        </div>
                    </div>


                    <div class="col-sm-12 col-lg-9">
                        <div class="tc-tabs-style6">
                            <base-homepage-categories-tabs :categories="{{ $top_categories }}"></base-homepage-categories-tabs>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($most_viewed) > 0)
        <section class="cards-block my-0 py-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 tc-post-grid-style1 sec-spacer">
                        <base-heading text="{{ __('strings.students_are_viewing') }}"></base-heading>
                        <base-slick-carousel :num_slides="5" :courses="{{ json_encode($most_viewed) }}"></base-slick-carousel>
                    </div>
                </div>
            </div>
        </section>
    @endif
    
    @if(count($top_subcategories) > 0)
        <!-- TOP CATEGORIES -->
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 tc-post-grid-style1 sec-spacer">
                        <base-heading text="{{ __('strings.top_categories') }}"></base-heading>
                    </div>
                </div>
            
                <div class="row">
                    @foreach($top_subcategories as $subcategory)
                        <base-home-category-card :category="{{ json_encode($subcategory) }}"></base-home-category-card>
                    @endforeach 
                </div>
            
            </div>
        </section>
    @endif

</section>

@endsection
