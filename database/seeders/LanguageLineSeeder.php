<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lines = [
            ['group' => 'category', 'key' => 'page_title', 'text' => json_encode(['en' => 'Categories', 'ar' => 'مطلوب'])],
        ];

        LanguageLine::insert($lines);
    }
}
