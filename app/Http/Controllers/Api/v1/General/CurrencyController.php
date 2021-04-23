<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Resources\CurrencyResource;
use App\Repositories\Contracts\ICurrency;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    

    protected $currencies;

    public function __construct(ICurrency $currencies)
    {
        $this->currencies = $currencies;
    }


    public function index()
    {
        $currencies = $this->currencies->getAll();
        return CurrencyResource::collection($currencies);
    }



}
