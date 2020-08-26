<?php

use App\Post;
use Illuminate\Database\Seeder;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Tag;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Post::truncate();
        Tag::truncate();

        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
        ]);

        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@mail.com',
        ]);

        factory(Category::class, 5)->create();
        factory(Post::class, 200)->create();
        factory(Tag::class, 200)->create();
    }
}
