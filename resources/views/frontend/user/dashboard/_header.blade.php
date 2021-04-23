<section class="text-white py-4 jumbotron__with_breadcrumb d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4">
                @if(! $show_menu)
                    <nav aria-label="breadcrumb bg-transparent">
                        <ol class="breadcrumb bg-transparent mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="/"><i class="fa fa-home text-muted"></i></a>
                            </li>
                            <li class="breadcrumb-item text-white">
                                <a href="/home/my-courses/purchases" class="text-muted">@lang('strings.purchase_history')</a>
                            </li>
                            <li class="breadcrumb-item text-white">
                                @lang('strings.receipt')
                            </li>
                        </ol>
                    </nav>
                @endif
                <div class="h1 fw-300 mb-0">
                    {{ $title }}
                </div>
            </div>
        </div>
    </div>
</section>
@if($show_menu)
    <section class="filters-block designer-profile p-0">
        <div class="container">
            <div class="filters text-center d-flex justify-content-center align-items-center">
                <ul class="search-filter active-state hover-state list-color font-16 fw-400 author-dashboard">
                    <li>
                        <a href="{{ route('frontend.user.dashboard.courses') }}" 
                            class="p-3 {{ active_class( Route::is('frontend.user.dashboard.courses') )  }}" >
                            @lang('strings.all_courses')
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.user.dashboard.purchases') }}" 
                            class="p-3 {{ active_class( Route::is('frontend.user.dashboard.purchases') )  }}" >
                            @lang('strings.purchase_history')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endif