<footer class="app-footer">
    <div>
        <strong>
            @lang('labels.general.copyright') &copy; {{ date('Y') }}
            {{ app_name() }}
        </strong> @lang('strings.backend.general.all_rights_reserved')
    </div>

    <div class="ml-auto">
        {{ app_name() }} v{{ app_version() }}    
    </div>
</footer>
