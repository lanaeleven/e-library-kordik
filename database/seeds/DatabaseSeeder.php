<?php

use App\Book;
use Illuminate\Database\Seeder;
Use App\Enums\Category;

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
            'category' => Category::FARMASI,
            'author' => 'Tati Suhartati',
            'folder' => 'farmasi/book_1',
            'total_pages' => 106,
        ]);
        Book::create([
            'title' => 'Kimia Analisis',
            'author' => 'Jamiliatur Rohmah dan Chylen Setiyo Rini',
            'category' => Category::FARMASI,
            'folder' => 'farmasi/book_2',
            'total_pages' => 141,
        ]);
        Book::create([
            'title' => 'Foreksik dan Medikolegal',
            'author' => 'dr. Abdul Gafar Parinduri',
            'category' => Category::KEDOKTERAN,
            'folder' => 'kedokteran/book_1',
            'total_pages' => 415,
        ]);
        Book::create([
            'title' => 'Burn Care and Treatment A Practical Guide',
            'author' => 'Marc G. Jeschke dan Lars-Peter Kamolz',
            'category' => Category::KEDOKTERAN,
            'folder' => 'kedokteran/book_2',
            'total_pages' => 185,
        ]);
        Book::create([
            'title' => 'Konsep Keperawatan Medikal Bedah',
            'author' => 'Dewi Apriadi, dkk',
            'category' => Category::KEPERAWATAN,
            'folder' => 'keperawatan/book_1',
            'total_pages' => 45,
        ]);
        Book::create([
            'title' => 'Keperawatan Gawat Darurat',
            'author' => 'Andi Herman, dkk',
            'category' => Category::KEPERAWATAN,
            'folder' => 'keperawatan/book_2',
            'total_pages' => 61,
        ]);
    }
}
