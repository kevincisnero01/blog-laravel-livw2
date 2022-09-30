<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create folder: posts
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        //Create records: 20 posts
         \App\Models\Post::factory(50)->create();
    }
}
