
<base-nav-mobile inline-template>
    <div>
        <div class="navbar navbar-expand-lg navbar-light p-0 gabs__main_nav" v-cloak>
            <div class="nav_inner d-flex align-items-center justify-content-between">
                <!-- Search and expand icons for mobile only -->
                <div class="nav__mob_icons">
                    <a href="#mobileMenu">
                        <div class="bars">
                            <i class="fa fa-bars font-26 font-weight-light"></i>
                        </div>
                    </a>
                </div>
                
                <a class="navbar-brand logo__wrap mr-0" href="{{ route('frontend.index') }}">
                    <img src="{{ setting('site.logo') }}" class=img-responsive />
                </a>
                
                <div class="search_icon">
                    <div class="d-flex align-items-center justify-content-between">
                        <base-nav-cart inline-template>
                            <a href="/cart" class="gabs__dropdown-toggle gabs__hover_grey" role="button">
                                <div class="fx pos-r text-center">
                                    <span class="fa fa-shopping-cart dropdown__main_icon gicon font-25"></span>
                                    <template v-if="!loading && cart.item_count > 0">
                                        <sup><span class="badge badge-pill badge-danger">
                                            @{{ cart.item_count > 9 ? '9+' : cart.item_count }}
                                        </span></sup>
                                    </template>
                                </div>
                            </a>
                        </base-nav-cart>
                    </div>
                </div>
            </div>
        </div>
        <transition name="slidedown">
            <form class="form-inline mt-2 mob-form" v-if="showSearch">
                <input class="form-control form-control-lg rounded-0" type="search" placeholder="Search for Courses" aria-label="Search">
                <button class="btn btn-outline-success search-icon" type="submit">
                    <i class="fa fa-search"></i>
                </button> 
            </form> 
        </transition>
        
        <!-- The menu -->
        <nav id="mobileMenu">
            <ul>
                @auth
                    <li>
                        <a href="/user/{{$logged_in_user->username}}" >
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <img src="{{ $logged_in_user->picture }}" width="50" class="rounded-circle"/>
                                </div>
                                <div class="mob_user_meta d-flex">
                                    <span class="fx">
                                        <span class="text-midnight ellipsis">@lang('strings.hi_user', [$logged_in_user->full_name])</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li><a href="/home/my-courses/purchases">@lang('strings.purchase_history')</a></li>
                            <li><a href="/home/messages">@lang('strings.messages')</a></li>
                            <li><a href="/home/instructor/revenue">@lang('strings.revenue_report')</a></li>
                            <li><a href="/user/{{$logged_in_user->username}}">@lang('strings.public_profile')</a></li>
                            <li><a href="/account">@lang('strings.edit_profile')</a></li>
                        </ul>
                    </li>
                @endauth

                <li><a href="/">@lang('strings.home')</a></li>
                <li>
                    <a href="javascript:void(0)">@lang('strings.categories')</a>
                    <ul>
                        @foreach($gcategories as $category)
                            <li>
                                <a href="/courses/{{ $category->slug }}">{{ $category->name }}</a>
                                <ul>
                                    <li>
                                        <a href="/courses/{{ $category->slug }}" class="font-weight-bold">
                                            @lang('strings.all_in_category', ['category'  => $category->name])
                                        </a>
                                    </li>
                                    @foreach($category->children as $child)
                                        <li>
                                            <a href="/courses/{{ $category->slug }}/{{ $child->slug }}">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                   </ul>
                </li>
                @auth
                    <li><a href="/home/my-courses/learning">@lang('strings.my_courses')</a></li>
                    <li><a href="/home/instructor/overview">@lang('strings.instructor')</a></li>
                    <li><a href="/logout">@lang('strings.logout')</a></li>
                @else
                    <li><a href="/register">@lang('strings.register')</a></li>
                    <li><a href="/login">@lang('strings.login')</a></li>
                @endauth
                
             </ul>
        </nav>

    </div>
</base-nav-mobile>