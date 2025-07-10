<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::firstOrCreate([
            'name' => 'Laravel Tips',
            'url' => 'https://laravel-tips.com'
        ]);

        Website::firstOrCreate([
            'name' => 'Rofik Blog',
            'url' => 'https://rofik-blog.com'
        ]);
    }
}
