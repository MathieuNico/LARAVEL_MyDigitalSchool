<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categorie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'toto',
            'email' => 'toto@example.com',
        ]);

        Categorie::factory(5)->create();

        for($i =0; $i < 20; $i++){
            Categorie::factory(1)->create([
                'parent_id' => random_int(1,5),
            ]);
        }

        

        
    }
}
