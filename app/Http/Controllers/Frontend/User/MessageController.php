<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        return view('frontend.messages.Chat', compact('user'));
    }
    
}
