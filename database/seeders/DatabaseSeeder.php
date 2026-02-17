<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MultimediaItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
        Category::create([
            'name' => 'Kamera',
        ]);
        MultimediaItem::create([
            'name' => 'Canon EOS R5',
            'category_id' => '1',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat dolores eaque inventore ipsum molestias? Illum sint ad asperiores fugiat repudiandae? Velit quod praesentium dignissimos fugiat, repudiandae obcaecati. Esse, labore at!',
            'price_per_day' => 250000,
            'image' => '09-02-2026_9EPzjKYQQ0zyyuUGf9Fwqx20XA23LkK36Z06xiRP.jpg',
        ]);
    }
}
