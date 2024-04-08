<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        \App\Models\User::factory(10)->create();
        \App\Models\Track::factory(10)->create();
        \App\Models\Course::factory(10)->create();
        \App\Models\Video::factory(10)->create();
        \App\Models\Quiz::factory(10)->create();
        \App\Models\Question::factory(10)->create();
        \App\Models\Photo::factory(10)->create();
    }
}
