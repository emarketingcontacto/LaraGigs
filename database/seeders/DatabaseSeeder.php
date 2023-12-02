<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       \App\Models\User::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Listing::create([
            'title'=>'Laravel Developer',
            'tags' => 'laravel, javascrip',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'email@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab, natus,
            tenetur nulla eveniet vero id cumque delectus culpa quae deleniti dolorem ipsa eligendi
            labore ducimus exercitationem molestiae, voluptate quas repudiandae',
        ]);

        Listing::create([
            'title'=>'Laravel Developer',
            'tags' => 'laravel, javascrip',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'email@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab, natus,
            tenetur nulla eveniet vero id cumque delectus culpa quae deleniti dolorem ipsa eligendi
            labore ducimus exercitationem molestiae, voluptate quas repudiandae',
        ]);


    }
}
