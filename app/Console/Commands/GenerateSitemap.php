<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Menambahkan URL statis
        $sitemap->add(Url::create(url('/'))->setPriority(1.0)->setChangeFrequency('daily'));
        $sitemap->add(Url::create(url('/titik-kami'))->setPriority(1.0)->setChangeFrequency('daily'));
        $sitemap->add(Url::create(url('/services'))->setPriority(0.8)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create(url('/portfolio'))->setPriority(0.8)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create(url('/contact'))->setPriority(0.8)->setChangeFrequency('monthly'));

        // Menambahkan URL dinamis (contohnya dari database)
        $posts = \App\Models\FrontArticle::all();
        foreach ($posts as $post) {
            $sitemap->add(Url::create(url("/artikel/{$post->slug}"))
                ->setLastModificationDate($post->updated_at)
                ->setPriority(1)
                ->setChangeFrequency('weekly'));
        }

        $titik_kami_posts = \App\Models\Item::all();
        foreach ($titik_kami_posts as $post) {
            $sitemap->add(Url::create("/listing/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
                ->setPriority(1)
                ->setChangeFrequency('weekly'));
        }

        // $titik_kami_byprov = \App\Models\Province::all();
        // foreach ($posts as $post) {
        //     $sitemap->add(Url::create("/listing/{$titik_kami_byprov->slug}")
        //         ->setLastModificationDate($titik_kami_byprov->updated_at)
        //         ->setPriority(1)
        //         ->setChangeFrequency('weekly'));
        // }

        // $titik_kami_bycity = \App\Models\Item::all();
        // foreach ($posts as $post) {
        //     $sitemap->add(Url::create("/listing/{$titik_kami_bycity->slug}")
        //         ->setLastModificationDate($titik_kami_bycity->updated_at)
        //         ->setPriority(1)
        //         ->setChangeFrequency('weekly'));
        // }
        // Simpan sitemap ke public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
