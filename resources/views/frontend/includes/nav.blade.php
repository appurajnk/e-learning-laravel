<nav class="navbar navbar-expand-lg navbar-light p-0 gabs__main_nav">
    <div class="nav_inner">
        <!-- LOGO -->
        <div class="nav__logo">
            <a href="{{ route('frontend.index') }}" class="navbar-brand logo__wrap">
                <img src="{{ setting('site.logo') }}" class=img-responsive />
            </a>
        </div>

        <!-- Left Side { categories, search bar } -->
        <div class="nav__left_container">
            <div class="gabs__dropdown dropdown--on-hover dropdown--topics">
                <a href="javascript:void(0)" class="gabs__dropdown-toggle" role="button">
                    <span class="fa fa-th gicon"></span>
                    <span>
                        @lang('strings.categories')
                    </span>
                </a>
                @if(count($gcategories) > 0)
                    <base-nav-category-dropdown :categories="{{ json_encode($gcategories) }}"></base-nav-category-dropdown>
                @endif
            </div>
            <!-- Search bar -->
            <div class="nav__search_wrapper">
                <div class="nav__search">
                    <div class="nav__quick_search_form pos-r">
                        <div class="gabs__dropdown">
                            <base-nav-search></base-nav-search>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="nav__right_container">
            @auth
                <div class="nav__instructor_dropdown visible-lg-block">
                    <div class="gabs__dropdown dropdown--on-hover dropdown--instructor zero-state">
                        <a href="/home/instructor/overview" class="gabs__dropdown-toggle gabs__hover_grey" role="button">
                            @lang('strings.instructor')
                        </a>
                    </div>
                </div>

                <div class="nav__instructor_dropdown visible-lg-block">
                    <div class="gabs__dropdown dropdown--on-hover dropdown--instructor zero-state">
                        <a class="gabs__dropdown-toggle gabs__hover_grey" role="button" href="/home/my-courses/learning">
                            @lang('strings.my_courses')
                        </a>
                    </div>
                </div>

                <base-nav-cart></base-nav-cart>

                <!-- User -->
                <base-nav-user-dropdown :user="{{ json_encode($logged_in_user) }}" isAdmin="{{ $logged_in_user->isAdmin() }}"></base-nav-user-dropdown>
            @endauth

            @guest 
                <base-nav-cart></base-nav-cart>
                <div class="nav__instructor_dropdown visible-lg-block ml-3">
                    <div class="gabs__dropdown dropdown--on-hover dropdown--instructor zero-state">
                        <a href="/login" class="border gabs__dropdown-toggle gabs__hover_grey font-16">
                            @lang('strings.login')
                        </a>
                    </div>
                </div>
                
                <div class="nav__instructor_dropdown visible-lg-block ml-2">
                    <div class="gabs__dropdown dropdown--on-hover dropdown--instructor zero-state">
                        <a href="/register" class="border btn-danger gabs__dropdown-toggle gabs__hover_grey text-white danger-hover-dark font-16">
                            @lang('strings.register') 
                        </a>
                    </div>
                </div>
            @endguest
        </div>


    </div>
</nav>
