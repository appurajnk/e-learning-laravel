<?php
use App\Models\Lesson;
use App\Utilities\Updater;

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            }

            return 'frontend.index';
        }

        return 'frontend.index';
    }

    
}
if( ! function_exists('format_currency')){
    
    function format_currency($value)
    {
        $value = (string)$value;
        $default_currency = setting('site.site_currency') ?: 'USD';
        $currency = \App\Models\Currency::where('code', setting('site.site_currency'))->first();

        if($currency->space_between){
            if($currency->symbol_position=='left') return $currency->symbol . ' ' . $value;
            return str($value) . ' ' . $currency->symbol_position; 
        } else {
            if($currency->symbol_position=='left') return $currency->symbol . $value;
            return str($value) . $currency->symbol; 
        }
    }
    
}

if( ! function_exists('artisan_migrate')){
    function artisan_migrate() 
    {
        \Artisan::call('migrate', ["--force"=> true]);
    }
}

if( ! function_exists('artisan_clear')){
    function artisan_clear() {
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
    }
}

if( ! function_exists('number_to_percentage')){
    function number_to_percentage($number, $precision = 2)
    {
        if (!is_numeric($number)) {
            return $number;
        }
        return sprintf("%.{$precision}f%%", $number * 100);
    }
}

if( ! function_exists('app_version')){
    function app_version()
    {
        return trim(file_get_contents(base_path('VERSION')));
    }
}

/**
 * Check if the app is installed
 *
 * @return boolean
 */
if( ! function_exists('installed')){
    function installed()
    {
        // removed installer entirely
        return true;
        //return \Storage::disk('installPath')->exists('INSTALL/site_installed.key');
    }

}

if( ! function_exists('request_ip')){

    function request_ip()
    {
        return request()->getClientIp();
    }
}

if (! function_exists('camelcase_to_word')) {
    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}


if( !function_exists('convert_minutes_to_duration'))
{
    function convert_minutes_to_duration($total_minutes, $format = '%02d:%02d:%02d')
    {
        if ($total_minutes < 0.0 || ! $total_minutes) {
            return '00:00:00';
        }
        
        $hours = floor($total_minutes / 60);
        $minutes = ($total_minutes % 60);
        $seconds = ($total_minutes*60) % 60;
        
        return sprintf($format, $hours, $minutes, $seconds);
    }
    
}

if( !function_exists('convert_hours_to_duration'))
{
    function convert_hours_to_duration($total_hours, $format = '%02d:%02d:%02d')
    {
        $total_minutes = $total_hours * 60;
        if ($total_minutes < 0.0 || ! $total_minutes) {
            return '00:00:00';
        }
        
        $hours = floor($total_minutes / 60);
        $minutes = ($total_minutes % 60);
        $seconds = ($total_minutes*60) % 60;
        
        return sprintf($format, $hours, $minutes, $seconds);
    }
    
}

if (! function_exists('get_first_lesson')) {
    function get_first_lesson($course){
        $first_lesson = Lesson::where('lessons.course_id', $course->id)
            ->join('sections', 'sections.id', 'lessons.section_id')
            ->orderBy('sections.sortOrder')
            ->orderBy('lessons.sortOrder')
            ->first();
        
        if(auth()->check()){
            $lessons = $course->lessons()->pluck('id');
            $last_watched = auth()->user()->completions()->latest()
                                ->whereIn('lessons.id', $lessons)->first();
                                
            if(!is_null($last_watched)){
                $first_lesson = $last_watched;
            }
        }
        
        return $first_lesson;
    }
}

if (! function_exists('active_languages')) {
    function active_languages(){
        return \App\Models\Language::where('is_active', true)->get();
    }
}

if( !function_exists('get_latest_version_info')){
    function get_latest_version_info()
    {
        $currentVersion = Updater::checkLatestVersion();
        return $currentVersion;
    }
}

if( !function_exists('check_envato_license') )
{
    function check_envato_license()
    {
        $check = Updater::checkLicense();
        return $check;
    }
}


if(! function_exists('get_init_param_value')){
    function get_init_param_value($value)
    {
        $rtn = 0;
        if (preg_match('/^(\d+)(.)$/', $value, $matches)) {
            if ($matches[2] == 'M') {
                $rtn = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
            } else if ($matches[2] == 'K') {
                $rtn = $matches[1] * 1024; // nnnK -> nnn KB
            }
        }
        
        return $rtn;
    }
}
if(! function_exists('get_upload_max_size')){
    function get_upload_max_size()
    {
        $post_max = get_init_param_value(ini_get('post_max_size'));
        $upload_max_filesize = get_init_param_value(ini_get('upload_max_filesize'));
        
        return min($post_max, $upload_max_filesize) / 1024 / 1024;
    }
}

if(! function_exists('is_envato')){

    function is_envato(){
        return auth()->check() && auth()->user()->email == 'envato@example.net';
    }
    
}

if(! function_exists('array_diff_assoc_recursive')){
    function array_diff_assoc_recursive($array1, $array2)
    {
        foreach($array1 as $key => $value){
    
            if(is_array($value)){
                if(!isset($array2[$key]))
                {
                    $difference[$key] = $value;
                }
                elseif(!is_array($array2[$key]))
                {
                    $difference[$key] = $value;
                }
                else
                {
                    $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                    if($new_diff != FALSE)
                    {
                        $difference[$key] = $new_diff;
                    }
                }
            }
            elseif((!isset($array2[$key]) || $array2[$key] != $value) && !($array2[$key]===null && $value===null))
            {
                $difference[$key] = $value;
            }
        }
        return !isset($difference) ? 0 : $difference;
    }
}

if(! function_exists('get_language_strings'))
{
    function get_language_strings($lang){
        if($lang !== 'en'){
            // Get english strings
            $english_files   = glob(resource_path('lang/en/*.php'));
            $strings_en = [];
            foreach ($english_files as $file) {
                $name = basename($file, '.php');
                $strings_en[$name] = require $file;
            }

            // get selected language strings
            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];
            foreach ($files as $file) {
                $name = basename($file, '.php');
                $strings[$name] = require $file;
            }

            // get difference between selected and engligh
            $diff = \Arr::dot(array_diff_assoc_recursive($strings_en, $strings));

            // append difference to selected
            foreach($diff as $key => $value){
                data_fill($strings, $key, $value);
            }

            return $strings;

        } else {
            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];
            foreach ($files as $file) {
                $name = basename($file, '.php');
                $strings[$name] = require $file;
            }
            return $strings;
        }
    }
}
