<?php

namespace App\Console\Commands;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use App\Models\FrontArticle;
use App\Models\Item;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate multilingual sitemap';

    public function handle()
    {
        $languages = ['id', 'en']; // Menambahkan bahasa yang digunakan

        foreach ($languages as $lang) {
            $sitemap = Sitemap::create();

            // ✅ URL statis
            $staticPages = [
                '/' => 1.0,
                '/titik-kami' => 1.0,
                '/services' => 0.8,
                '/portfolio' => 0.8,
                '/contact' => 0.8,
            ];

            foreach ($staticPages as $path => $priority) {
                // Menambahkan bahasa di depan URL
                $sitemap->add(
                    Url::create(url("/{$lang}{$path}"))
                        ->setPriority($priority)
                        ->setChangeFrequency('monthly')
                );
            }

            // ✅ Artikel dari database
            $posts = FrontArticle::all();
            foreach ($posts as $post) {
                // Menggunakan slug standar, tidak perlu `slug_id` atau `slug_en`
                $slug = $post->slug;
                $path = $lang === 'id' ? 'artikel' : 'article'; // Menyesuaikan dengan nama path per bahasa

                $sitemap->add(
                    Url::create(url("/{$lang}/{$path}/{$slug}"))
                        ->setLastModificationDate($post->updated_at)
                        ->setPriority(1)
                        ->setChangeFrequency('weekly')
                );
            }

            // ✅ Titik Kami (listing)
            $items = Item::all();
            foreach ($items as $item) {
                // Menggunakan slug standar untuk listing
                $slug = $item->slug;
                $sitemap->add(
                    Url::create(url("/{$lang}/listing/{$slug}"))
                        ->setLastModificationDate($item->updated_at)
                        ->setPriority(1)
                        ->setChangeFrequency('weekly')
                );
            }

            // ✅ Simpan ke file
            $sitemap->writeToFile(public_path("sitemap-{$lang}.xml"));
            $this->info("✔ sitemap-{$lang}.xml berhasil dibuat!");
        }
    }
}
