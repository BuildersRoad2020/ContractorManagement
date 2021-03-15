<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documents_Category;

class Documents_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documents = [
            ['id' => '1','name' => 'Individual Documents'],
            ['id' => '2','name' => 'Insurance Documents'],
            ['id' => '3','name' => 'Electrical Documents'],      
            ['id' => '4','name' => 'Work Area Documents'],         
        ];

        foreach($documents as $document) {
            Documents_Category::create($document);
            }        
    
    }
}
