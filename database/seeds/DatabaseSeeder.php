<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        // Disable foreign key checking because truncate() will fail
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('PRAGMA foreign_keys = OFF');
        Users::truncate();
        Post::truncate();
        Comment::truncate();
        factory(Users::class, 10)->create();
        factory(Post::class, 50)->create();
        factory(Comment::class, 100)->create();
        // Enable it back
        DB::statement('PRAGMA foreign_keys = ON');
        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
