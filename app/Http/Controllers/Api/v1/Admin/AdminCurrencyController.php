<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\CurrencyResource;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICurrency;

class AdminCurrencyController extends Controller
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:currencies,name',
            'symbol' => 'required',
            'code' => 'required|unique:currencies,code',
            'conversion_rate' => 'required',
            'symbol_position' => 'required|in:left,right'
        ]);

        return $this->currencies->store($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:currencies,name,'.$id,
            'symbol' => 'required',
            'code' => 'required|unique:currencies,code,'.$id,
            'conversion_rate' => 'required',
            'symbol_position' => 'required|in:left,right'
        ]);

        return $this->currencies->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->currencies->destroy($id);
    }

    public function markAsPrimary($id)
    {
        return $this->currencies->markAsPrimary($id);
    }

    public function toggleEnabled($id)
    {
        return $this->currencies->toggleEnabled($id);
    }

}
