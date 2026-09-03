<?php

use App\Book;
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
        // $this->call(UserSeeder::class);

        Book::create([
            'title' => 'Dasar-dasar Spektrofometri',
            'folder' => 'farmasi/book_1',
            'total_pages' => 106,
        ]);
        Book::create([
            'title' => 'Kimia Analisis',
            'folder' => 'farmasi/book_2',
            'total_pages' => 141,
        ]);
        Book::create([
            'title' => 'Foreksik dan Medikolegal',
            'folder' => 'kedokteran/book_1',
            'total_pages' => 415,
        ]);
        Book::create([
            'title' => 'Burn Care and Treatment A Practical Guide',
            'folder' => 'kedokteran/book_2',
            'total_pages' => 185,
        ]);
        Book::create([
            'title' => 'Konsep Keperawatan Medikal Bedah',
            'folder' => 'keperawatan/book_1',
            'total_pages' => 45,
        ]);
        Book::create([
            'title' => 'Keperawatan Gawat Darurat',
            'folder' => 'keperawatan/book_2',
            'total_pages' => 61,
        ]);
    }
}
