<?php

namespace App\Http\Controllers\Api\v1\Installer;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\Updater;

class UpdateController extends Controller
{
    

    public function updateToLatest()
    {
        set_time_limit(600);

        $status = Updater::getLatestVersion();

        if($status['success'] == false){
            return response()->json($status, 422);
        }
        
        return response()->json(null, 200);

    }

}
