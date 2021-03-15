<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Countries;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['id'=>'61',	'sortname'=>'AU',	'name'=>'Australia',	'phonecode'=>'61',],
            ['id'=>'1',	'sortname'=>'CA',	'name'=>'Canada',	'phonecode'=>'1',],
            ['id'=>'64',	'sortname'=>'NZ',	'name'=>'New Zealand',	'phonecode'=>'64',],
            
            
            ];
    
            foreach($countries as $country) {
            Countries::create($country);
            }
    }
}
