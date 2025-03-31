<?php

namespace App\Http\Controllers;

use App\Models\FrontArticle;
use App\Models\FrontProfile;
use App\Models\FrontTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class ArtikelController
 *
 * Kontroler untuk mengelola artikel pada aplikasi.
 *
 * @package App\Http\Controllers
 */
class ArtikelController extends Controller
{
    /**
     * Menampilkan daftar artikel terbaru dengan paginasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil artikel terbaru dengan paginasi 12 artikel per halaman
        $artikel = FrontArticle::latest()->paginate(12);

        // Mengambil artikel terbaru untuk ditampilkan di bagian atas
        $newArtikel = FrontArticle::latest()->first();

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.artikel' dengan data artikel, artikel terbaru, dan profil
        return view('user.artikel', [
            'data' => $artikel,
            'newArtikel' => $newArtikel,
            'profiles' => $profiles
        ]);
    }

    /**
     * Menampilkan detail artikel berdasarkan slug.
     *
     * @param string $slug Slug artikel yang akan ditampilkan
     * @return \Illuminate\View\View
     */
    public function detail($locale, $slug)
    {
        // Mengambil artikel berdasarkan slug

        Log::info('Locale:', ['locale' => $locale]);
        Log::info('Slug yang diterima:', ['slug' => $slug]);

        $checkSlug = FrontArticle::where('slug', $slug)->first();
        if (!$checkSlug) {
            Log::error("Artikel dengan slug '$slug' tidak ditemukan.");
            abort(404, 'Artikel tidak ditemukan');
        }

        $dTag = [];
        if (!empty($checkSlug->tags)) {
            foreach ($checkSlug->tags as $key => $tagId) {
                $tag = FrontTags::find($tagId);
                if ($tag) {
                    $dTag[$key] = $tag->name;
                }
            }
        }
        $checkSlug['text_tag'] = $dTag;

        // Mengambil artikel lain yang memiliki tag yang sama dengan artikel yang ditampilkan
        $article = FrontArticle::where(function ($q) use ($checkSlug) {
            foreach ($checkSlug->tags as $t) {
                $q->orWhereJsonContains('tags', $t);
            }
        })->latest()->paginate(12);

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.detailartikel' dengan data artikel dan artikel terkait
        return view('user.detailartikel', [
            'article' => $checkSlug,
            'data' => $article,
            'profiles' => $profiles
        ]);
    }

    /**
     * Menampilkan artikel berdasarkan tag.
     *
     * @param string $tag Nama tag yang akan dicari
     * @return \Illuminate\View\View
     */
    public function byTag($locale, $tag)
    {
        Log::info('Locale:', ['locale' => $locale]);
        // Mengambil ID tag berdasarkan nama tag
        $tagData = FrontTags::where('name', $tag)->first();

        // Mengambil artikel yang memiliki tag yang sesuai dengan tag yang dicari
        $article = FrontArticle::whereJsonContains('tags', (string)$tagData->id)->latest()->paginate(12);

        // Mengambil artikel terbaru untuk ditampilkan di bagian atas
        $newArtikel = FrontArticle::latest()->first();

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.artikelbytag' dengan data artikel berdasarkan tag dan artikel terbaru
        return view('user.artikelbytag', [
            'article' => $article,
            'newArtikel' => $newArtikel,
            'profiles' => $profiles,
        ]);
    }
}
