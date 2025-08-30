<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            DB::table('pages')->insert([
                'name' => $page,
                'slug' => Str::slug($page), // Automatically converts to lowercase and hyphenated
            ]);
        }
    }
}
