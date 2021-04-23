<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    
    
    public function cart()
    {
        return view('frontend.cart.ShoppingCart');
    }
    
    public function cartCheckout()
    {
        return view('frontend.cart.CartCheckout');
    }
    
}
