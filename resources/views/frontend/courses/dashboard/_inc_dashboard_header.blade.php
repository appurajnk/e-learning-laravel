<section class="py-0 bg-secondaryx jumbotron__with_player d-flex align-items-center" style="min-height: 250px;">
    <div class="container course__dashboard_header">
        <div class="row py-3 text-white">   
            <base-course-dashboard-header :course="{{ json_encode($course) }}"></base-course-dashboard-header>
        </div>
    </div>
</section>

<section class="filters-block designer-profile p-0">
    <div class="container">
        <div class="filters text-center d-flex justify-content-center align-items-center">
            <ul class="search-filter active-state hover-state list-color font-16 fw-400">
                <li class="m-none">
                    <a href="{{ route('frontend.course.dashboard.overview', $course->slug) }}" 
                        class="p-3 {{ active_class( Route::is('frontend.course.dashboard.overview') )  }}" >
                        @lang('strings.overview')
                    </a>
                </li>
                
                <li class="m-none">
                    <a href="{{ route('frontend.course.dashboard.content', $course->slug) }}" 
                        class="p-3 {{ active_class( Route::is('frontend.course.dashboard.content') )  }}">
                        @lang('strings.course_content')
                    </a>
                </li>
                
                <li class="m-none">
                    <a href="{{ route('frontend.course.dashboard.questions', $course->slug) }}" 
                        class="p-3 {{ active_class( Route::is('frontend.course.dashboard.questions') || Route::is('frontend.course.dashboard.questions.show') )  }}">
                        @lang('strings.q_and_a')
                    </a>
                </li>
                
                <li class="m-none">
                    <a href="{{ route('frontend.course.dashboard.announcements', $course->slug) }}" 
                        class="p-3 {{ active_class( Route::is('frontend.course.dashboard.announcements') )  }}">
                        @lang('strings.announcements')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>