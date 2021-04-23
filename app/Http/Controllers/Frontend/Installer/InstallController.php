<?php

namespace App\Http\Controllers\Frontend\Installer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstallController extends Controller
{

    public function index()
    {
        // session()->forget("install_step");
        // $step = session("install_step", 0);
        // session(["install_step" => 0]);
        return view('installer.Index');
    }

    public function requirements()
    {
        // $step = session("install_step");
        // if($step > 1) return redirect()->route('frontend.installer.database');
        // session(["install_step" => 1]);
        return view('installer.Requirements');
    }

    public function database()
    {
        // $step = session("install_step");
        // if($step > 2) return redirect()->route('frontend.installer.settings');        
        // session(["install_step" => 2]);
        return view('installer.Database');
    }

    public function settings()
    {
        // $step = session("install_step");
        // if($step > 3) return redirect()->route('frontend.installer.mail');

        // session(["install_step" => 3]);
        return view('installer.Settings');
    }

    public function mail()
    {
        // $step = session("install_step");
        // if($step > 4) return redirect()->route('frontend.installer.finish');

        // session(["install_step" => 4]);
        return view('installer.MailSettings');
    }

    public function finish()
    {
        // $step = session("install_step");
        // if($step < 4) return redirect()->route('frontend.installer.mail');
        // session(["install_step" => 5]);
        return view('installer.Finish');
    }

}
