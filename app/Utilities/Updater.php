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

class Updater
{
    private static $item = 'arcinspire';
    private static $latestUrl = 'api/latest';
    private static $checkLicenseUrl = 'api/verify';
    private static $downloadUrl = 'api/get_latest';

    public static function checkLicense()
    {
        $envato_username = setting('site.envato_username');
        $purchase_code = setting('site.purchase_code');

        if(! $envato_username || ! $purchase_code){
            return [
                'success' => false,
                'message' => 'Licence Information missing in your Settings Panel. Please update!'
            ];
        }
        
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]); //GuzzleHttp\Client
        try{
            $response = $client->request('POST', self::$checkLicenseUrl, [
                'form_params' => [
                    'purchase_code' => $purchase_code, 
                    'username' =>  $envato_username,
                    'item' => self::$item,
                    'omit_download' => true
                ],
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json'
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return [
                'success' => false,
                'message' => 'Server error while checking license'
            ];
        }

        

    }

    public static function checkLatestVersion()
    {
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]); 
        try{
            $response = $client->request('GET', self::$latestUrl, [
                'query' => ['item' => self::$item],
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json'
                ]
            ]);
        } catch (GuzzleException $e) {
            return ['success' => false];
        }

        if($response->getStatusCode() == 200){
            $version = json_decode($response->getBody()->getContents());
            $update_required = version_compare(app_version(), $version->version_number, '<');
            return ['success' => true, 'update_required' => $update_required, 'version' => $version->version_number];
        }
        return ['success' => false];
    }

    public static function getLatestVersion()
    {
        set_time_limit(600); // 10 minutes
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]);
        try {
            $release = $client->request('GET', self::$latestUrl, [
                'query' => ['item' => self::$item],
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json'
                ]
            ]);
            $res = json_decode($release->getBody(), true);

            if( $res['success'] == false){
                return [
                    'success' => false,
                    'error' => $res['message']
                ];
            }

            $download_path = storage_path('updates/downloads');
            if(!File::exists($download_path)) {
                File::makeDirectory($download_path, 0755, true, true);
            }

            $version = json_decode($release->getBody()->getContents());
            $file_path = storage_path('updates/downloads/'.$version->filename);
            // get the zip file
            $response = $client->request('GET', self::$downloadUrl, [  
                'query' => [
                    'purchase_code' => setting('site.purchase_code'),
                    'username' => setting('site.envato_username'),
                    'item' => self::$item
                ],
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json'
                ],
                'sink' => $file_path
            ]);
            
            $temp_path = storage_path('updates/tmp');
            if(!File::exists($temp_path)) {
                File::makeDirectory($temp_path, 0755, true, true);
            }
            
            // unzip the downloaded file to temp directory
            $zip = new ZipArchive();
            if (($zip->open($file_path) !== true) || !$zip->extractTo($temp_path)) {
                return [
                    'success' => false,
                    'error' => 'Unable to unzip update package'
                ];
            }
            $zip->close();
            File::delete($file_path);

            // copy the unzipped files and folders from the temp path to base directory
            if (!File::copyDirectory($temp_path, base_path())) {
                return [
                    'success' => false,
                    'error' => 'Error copying update files',
                ];
            }
            // empty the temp directory
            File::cleanDirectory($temp_path);
            
            // run migration if necessary
            if($version->should_migrate){
                Artisan::call('migrate', ['--force' => true]);
            }
            
            // Update the version number
            File::put(base_path('VERSION'), $version->version_number);

            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');

            return [
                'success' => true,
                'error' => false
            ];
        } catch(GuzzleException $e) {
            return [
                'success' => false,
                'error' => "Error occured"
            ];
        }

        return [
            'success' => true,
            'error' => false
        ];
    }


}