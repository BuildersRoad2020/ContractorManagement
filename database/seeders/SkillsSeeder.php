<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skills;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            ['id' => '1','name' => 'Media Player Installation'],
            ['id' => '2','name' => 'Screen Installation'],
            ['id' => '3','name' => 'LED Screen Installation']            
        ];

        foreach($skills as $skill) {
            Skills::create($skill);
            }        
    }
}
