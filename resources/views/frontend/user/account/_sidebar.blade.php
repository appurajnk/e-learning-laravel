<div class="list-group">
    <a href="{{ route('frontend.user.account') }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.user.account')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.profile_information')
    </a>

    <a href="{{ route('frontend.user.account.password') }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.user.account.password')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.change_password')
    </a>

    <!-- <a href="{{ route('frontend.user.account.privacy') }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.user.account.privacy')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.privacy_settings')
    </a> -->

    <a href="{{ route('frontend.user.account.payout') }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.user.account.payout')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.payout_settings')
    </a>
</div>