<?php

use Illuminate\Database\Seeder;
use App\Song;
class SongsTableSeeder extends Seeder
{
    public function run()
    {
      // Let's truncate our existing records to start from scratch.
        Song::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Song::create([
                'name' => $faker->name,
                'artist' => $faker->name,
            ]);
        }
    }
}
