<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Models\Section;
use App\Repositories\Contracts\ICurrency;
use App\Http\Resources\CurrencyResource;


class CurrencyRepository extends RepositoryAbstract implements ICurrency
{
    
    public function entity()
    {
        return Currency::class;
    }
    
    public function findByCode($code)
    {
        return Currency::where('code', $code)->first();
    }

    public function getAll()
    {
        return Currency::orderBy('is_primary', 'desc')->orderBy('code')->get();
    }

    public function store(array $data)
    {
        $currency = Currency::create([
            'name' => $data['name'],
            'code' => strToUpper($data['code']),
            'symbol' => $data['symbol'],
            'symbol_position' => $data['symbol_position'],
            'space_between' => $data['space_between'],
            'conversion_rate' => $data['conversion_rate'],
            'enabled' => $data['enabled']
        ]);
        return $currency;
    }

    public function update(array $data, $id)
    {
        $currency = Currency::find($id);
        $currency->update([
            'name' => $data['name'],
            'code' => strToUpper($data['code']),
            'symbol' => $data['symbol'],
            'symbol_position' => $data['symbol_position'],
            'space_between' => $data['space_between'],
            'conversion_rate' => $data['conversion_rate']
        ]);
        
        return $currency;
    }

    public function destroy($id)
    {
        Currency::find($id)->delete();
    }

    public function markAsPrimary($id)
    {
        Currency::all()->each(function ($c) {
            $c->is_primary = false;
            $c->save();
        });
        
        Currency::find($id)
            ->update([
                'is_primary' => true,
                'enabled' => true,
                'conversion_rate' => 1
            ]);
    }


    public function toggleEnabled($id)
    {
        $currency = Currency::find($id);
        if($currency->is_primary == true) return;
        $currency->enabled = ! $currency->enabled;
        $currency->save();
    }

    
    
    
    
}









