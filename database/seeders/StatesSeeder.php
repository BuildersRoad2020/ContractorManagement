<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\States;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['id'=>'1',	'name'=>'Ontario',	'countries_id'=>'1',],
            ['id'=>'2',	'name'=>'Manitoba',	'countries_id'=>'1',],
            ['id'=>'3',	'name'=>'New Brunswick',	'countries_id'=>'1',],
            ['id'=>'4',	'name'=>'Yukon',	'countries_id'=>'1',],
            ['id'=>'5',	'name'=>'Saskatchewan',	'countries_id'=>'1',],
            ['id'=>'6',	'name'=>'Prince Edward Island',	'countries_id'=>'1',],
            ['id'=>'7',	'name'=>'Alberta',	'countries_id'=>'1',],
            ['id'=>'8',	'name'=>'Quebec',	'countries_id'=>'1',],
            ['id'=>'9',	'name'=>'Nova Scotia',	'countries_id'=>'1',],
            ['id'=>'10',	'name'=>'British Columbia',	'countries_id'=>'1',],
            ['id'=>'11',	'name'=>'Nunavut',	'countries_id'=>'1',],
            ['id'=>'12',	'name'=>'Newfoundland and Labrador',	'countries_id'=>'1',],
            ['id'=>'13',	'name'=>'Northwest Territories',	'countries_id'=>'1',],
            ['id'=>'14',	'name'=>'Victoria',	'countries_id'=>'61',],
            ['id'=>'15',	'name'=>'South Australia',	'countries_id'=>'61',],
            ['id'=>'16',	'name'=>'Queensland',	'countries_id'=>'61',],
            ['id'=>'17',	'name'=>'Western Australia',	'countries_id'=>'61',],
            ['id'=>'18',	'name'=>'Australian Capital Territory',	'countries_id'=>'61',],
            ['id'=>'19',	'name'=>'Tasmania',	'countries_id'=>'61',],
            ['id'=>'20',	'name'=>'New South Wales',	'countries_id'=>'61',],
            ['id'=>'21',	'name'=>'Northern Territory',	'countries_id'=>'61',],
            ['id'=>'22',	'name'=>'Northland Region',	'countries_id'=>'64',],
            ['id'=>'23',	'name'=>'Manawatu-Wanganui Region',	'countries_id'=>'64',],
            ['id'=>'24',	'name'=>'Waikato Region',	'countries_id'=>'64',],
            ['id'=>'25',	'name'=>'Otago Region',	'countries_id'=>'64',],
            ['id'=>'26',	'name'=>'Marlborough Region',	'countries_id'=>'64',],
            ['id'=>'27',	'name'=>'West Coast Region',	'countries_id'=>'64',],
            ['id'=>'28',	'name'=>'Wellington Region',	'countries_id'=>'64',],
            ['id'=>'29',	'name'=>'Canterbury Region',	'countries_id'=>'64',],
            ['id'=>'30',	'name'=>'Chatham Islands',	'countries_id'=>'64',],
            ['id'=>'31',	'name'=>'Gisborne District',	'countries_id'=>'64',],
            ['id'=>'32',	'name'=>'Taranaki Region',	'countries_id'=>'64',],
            ['id'=>'33',	'name'=>'Nelson Region',	'countries_id'=>'64',],
            ['id'=>'34',	'name'=>'Southland Region',	'countries_id'=>'64',],
            ['id'=>'35',	'name'=>'Auckland Region',	'countries_id'=>'64',],
            ['id'=>'36',	'name'=>'Tasman District',	'countries_id'=>'64',],
            ['id'=>'37',	'name'=>'Bay of Plenty Region',	'countries_id'=>'64',],
            ['id'=>'38',	'name'=>'Hawkes Bay Region',	'countries_id'=>'64',],
            
            
        ];
    
        foreach($states as $state) {
            States::create($state);
        }
    }
}
