<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = ['Home', 'About', 'Service', 'Specialists', 'Blog', 'Contact'];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => Str::slug($page)],
                ['name' => $page]
            );
        }
    }
}
