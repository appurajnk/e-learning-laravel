<?php

use Illuminate\Database\Seeder;
use App\Models\Country;
class CountrySeeder extends Seeder
{
    const CountriesJSON = __DIR__.'/countries.json';
    
    public function run()
    {
        $this->countries()
            ->each(function ($country) {
                Country::create($country);
            });
    }
    
    public function countries()
    {
        $countries = json_decode(\File::get(self::CountriesJSON), true);
        return collect($countries);
    }
}
