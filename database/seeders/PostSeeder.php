<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::all();
        foreach ($members as $svdvssdv) {
            $posts  = Post::factory(20)->for($svdvssdv)->create();
        }
    }
}
