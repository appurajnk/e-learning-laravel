<?php

namespace App\Http\Controllers\Api\v1\Installer;

use File;
use Illuminate\Validation\Rule;
use App\Utilities\Installer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\EmailSettingsTest;

class InstallController extends Controller
{
    

    public function checkRequirements()
    {
        $result = Installer::checkServerRequirements();
        return response()->json($result, 200);
    }

    public function checkLicense(Request $request)
    {
        $this->validate($request, [
            'purchase_code' => ['required'],
            'username' => ['required']
        ]);

        if(!Installer::checkLicense($request->all())){
            return response()->json(['purchase_code' => 'Unable to validate the purchase. Please check the username and purchase code'], 422);
        }

        $envato = session([
            'purchase_code' => $request->purchase_code, 
            'envato_username' => $request->username
        ]);

        // cache()->rememberForever('purchase_code', $request->purchase_code); 
        // cache()->rememberForever('envato_username', $request->username);
        return response()->json(null, 200);

    }

    public function getDatabaseInfo()
    {
        $info = [
            'db_host' => env('DB_HOST'),
            'db_name' => env('DB_DATABASE'),
            'db_user' => env('DB_USERNAME'),
            'db_port' => env('DB_PORT'),
            'db_password' => env('DB_PASSWORD')
        ];

        return response()->json($info, 200);
    }

    public function setDatabase(Request $request)
    {
        $this->validate($request, [
            'db_host' => 'required',
            'db_name' => 'required',
            'db_user' => 'required',
            'db_port' => 'required',
            //'db_password' => 'required'
        ]);

        $host = $request['db_host'];
        $port = $request['db_port'];
        $database = $request['db_name'];
        $username = $request['db_user'];
        $password = $request['db_password'];

        // Check database connection
        if (!Installer::createDbTables($host, $port, $database, $username, $password)) {
            $message = trans('install.error.connection');
            return response()->json(['connection_error' => $message], 404);
        }

        return response()->json(null, 200);
    }

    public function saveSettings(Request $request)
    {
        try{
            \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
            \DB::table('users')->truncate();
            \DB::statement("SET FOREIGN_KEY_CHECKS = 1");
        } catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong.'], 404);
        }
       
        $this->validate($request, [
            'site_name' => ['required'],
            'username' => ['required', 'string', 'alpha_dash', 'max:15', Rule::unique('users')],
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
            
        // Create user
        $user = Installer::createUser($request->all());

        // save the purchase details from cache
        setting([
            "site.site_name" => $request->site_name,
            "site.purchase_code" => session('purchase_code'),
            "site.envato_username" => session('envato_username'),
            "site.site_url" => url('/')
        ]);
        setting()->save();
        session()->forget('purchase_code');
        session()->forget('envato_username');
        return response()->json($user, 200);
    }

    public function saveMailSettings(Request $request)
    {
        $this->validate($request, [
            'driver' => ['required'],
            'smtp_host' => ['required_if:driver,smtp'],
            'smtp_username' => ['required_if:driver,smtp'],
            'smtp_password' => ['required_if:driver,smtp'],
            'smtp_port' => ['required_if:driver,smtp'],
            
            'ses_key' => ['required_if:driver,ses'],
            'ses_secret' => ['required_if:driver,ses'],
            'ses_region' => ['required_if:driver,ses'],

            'sendmail_path' => ['required_if:driver,sendmail'],

            'sparkpost_secret' => ['required_if:driver,sparkpost'],

            'postmark_token' => ['required_if:driver,postmark'],
            
            'mailgun_domain' => ['required_if:driver,mailgun'],
            'mailgun_secret' => ['required_if:driver,mailgun'],
            'mailgun_endpoint' => ['required_if:driver,mailgun'],

            'from_address' => ['required'],
            'from_name' => ['required']
        ]);

        $data = $request->all();
        collect($data)->each(function ($v, $key) {
            setting(["mail.{$key}" => $v]);
        });
        setting()->save();

        return response()->json(null, 200);

    }

    public function finish(Request $request)
    {
        
        try{
            if($request->import == true && ! Installer::seedSampleData()){
                return response()->json(['message' => 'Unable to load sample data'], 404);
            }
            if(! Installer::finalTouches()){
                return response()->json(['message' => 'Unable to finalize installation'], 404);
            }

            cache()->flush();
        }catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404); 
        }
        
        return response()->json(null, 200);
        
    }
}
