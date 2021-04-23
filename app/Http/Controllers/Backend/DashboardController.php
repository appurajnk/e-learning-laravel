<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Utilities\Updater;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //dd(request_ip());
        return view('backend.dashboard');
    }
    
}
