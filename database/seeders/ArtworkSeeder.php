<?php

namespace Database\Seeders;

use App\Models\Artwork;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan beberapa data buku ke dalam tabel artwork
        Artwork::create([
            'judul' => 'Pemrograman Web Dasar',
            'klien' => 'John Doe',
            'kategori' => 'Teknologi',
            'stok' => 10,
        ]);

        Artwork::create([
            'judul' => 'Belajar Laravel',
            'klien' => 'Jane Smith',
            'kategori' => 'Pemrograman',
            'stok' => 5,
        ]);

        Artwork::create([
            'judul' => 'Algoritma dan Struktur Data',
            'klien' => 'Albert Einstein',
            'kategori' => 'Ilmu Komputer',
            'stok' => 7,
        ]);

        Artwork::create([
            'judul' => 'Dasar-dasar Jaringan Komputer',
            'klien' => 'Michael Jordan',
            'kategori' => 'Jaringan',
            'stok' => 3,
        ]);

        Artwork::create([
            'judul' => 'Pengantar Kecerdasan Buatan',
            'klien' => 'Isaac Asimov',
            'kategori' => 'Kecerdasan Buatan',
            'stok' => 8,
        ]);
    }
}
