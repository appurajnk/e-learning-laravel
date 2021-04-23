<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Request::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/categories*')) }}" 
                    href="{{ route('admin.categories') }}">
                    <i class="nav-icon fas fa-folder"></i>
                    @lang('strings.categories')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/courses*')) }}" 
                    href="{{ route('admin.courses.all') }}">
                    <i class="nav-icon fas fa-book"></i>
                    @lang('strings.courses')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/coupons*')) }}" 
                    href="{{ route('admin.coupons') }}">
                    <i class="nav-icon fas fa-tags"></i>
                    @lang('strings.discount_coupons')
                </a>
            </li>

            <li class="nav-title">
                @lang('strings.finances')
            </li>
            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/transactions')) }}" 
                    href="{{ route('admin.finances.transactions') }}">
                    <i class="nav-icon fas fa-money-bill-alt"></i>
                    @lang('strings.transactions')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/payouts*')) }}" 
                    href="{{ route('admin.finances.payout.periods') }}">
                    <i class="nav-icon fas fa-credit-card"></i>
                    @lang('strings.payouts')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{active_class(Request::is('admin/refunds*')) }}" 
                    href="{{ route('admin.finances.refunds') }}">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    @lang('strings.refunds')
                </a>
            </li>



            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @if($logged_in_user->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{active_class(Request::is('admin/auth*')) }}" 
                        href="{{ route('admin.auth.user.index') }}">
                        <i class="nav-icon far fa-user"></i>
                        @lang('labels.backend.access.users.management')
                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{active_class(Request::is('admin/settings*')) }}" 
                        href="{{ route('admin.settings') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        @lang('strings.settings')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{active_class(Request::is('admin/translations*')) }}" 
                        href="{{ route('admin.translations.index') }}">
                        <i class="nav-icon fas fa-globe"></i>
                        @lang('strings.translations')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ active_class(Request::is('admin/pages*')) }}" 
                        href="{{ route('admin.pages') }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        @lang('strings.pages')
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
