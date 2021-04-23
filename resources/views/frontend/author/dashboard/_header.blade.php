<section class="text-white py-4 jumbotron__with_breadcrumb d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4">
                <div class="h1 fw-300 mb-0">
                    @lang('strings.instructor_dashboard')
                </div>
            </div>
        </div>
    </div>
</section>
<section class="filters-block designer-profile p-0">
    <div class="container">
        <div class="filters text-center d-flex justify-content-center align-items-center">
            <ul class="search-filter active-state hover-state list-color font-16 fw-400 author-dashboard">
                <!-- <li>
                    <a href="{{ route('frontend.author.dashboard.overview') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.overview') )  }}" >
                        @lang('strings.overview')
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('frontend.author.dashboard.courses') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.courses') )  }}" >
                        @lang('strings.courses')
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('frontend.author.dashboard.revenue') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.revenue') || Route::is('frontend.author.dashboard.revenue.statement'))  }}" >
                        @lang('strings.revenue_report')
                    </a>
                </li>

                

                <li>
                    <a href="{{ route('frontend.author.dashboard.qna') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.qna') )  }}" >
                        @lang('strings.q_and_a')
                    </a>
                </li>

                <li>
                    <a href="{{ route('frontend.author.dashboard.reviews') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.reviews') )  }}" >
                        @lang('strings.reviews')
                    </a>
                </li>

                <li>
                    <a href="{{ route('frontend.author.dashboard.announcements') }}" 
                        class="p-3 {{ active_class( Route::is('frontend.author.dashboard.announcements') )  }}" >
                        @lang('strings.announcements')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>