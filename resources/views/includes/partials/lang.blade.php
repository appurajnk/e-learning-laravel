<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @foreach(\App\Models\Language::where('is_active', true)->get() as $lang)
        @if($lang->carbon_code != app()->getLocale())
            <small><a href="{{ '/lang/'.$lang->carbon_code }}" class="dropdown-item pt-1 pb-1">@lang('menus.language-picker.langs.'.$lang->carbon_code)</a></small>
        @endif
    @endforeach
</div>